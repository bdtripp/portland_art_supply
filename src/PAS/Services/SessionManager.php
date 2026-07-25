<?php

declare(strict_types=1);

namespace PAS\Services;

use JsonException;
use PAS\Repositories\AccountRepository;
use PAS\Config\SessionConstants;
use PAS\Config\DbConstants;
use PAS\Config\PageConstants;
use PAS\Services\CartService;

/**
 * Manages all session-related operations.
 *
 * Provides a unified interface for reading and writing session values,
 * handling user identity storage, regenerating session IDs, persisting
 * session-backed cart data, restoring saved session state, and performing
 * HTTP redirects. This service centralizes all direct interaction with
 * PHP's native session mechanisms and coordinates session persistence
 * through AccountRepository.
 */
final class SessionManager
{
    public function __construct(
        private AccountRepository $accountRepository
    ) {
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function setUser(int $id, string $username): void
    {
        $this->set(SessionConstants::USER_ID_KEY, $id);
        $this->set(SessionConstants::USERNAME_KEY, $username);
    }

    public function setReturnToUrl(string $url): void
    {
        $this->set(SessionConstants::RETURN_TO_URL_KEY, $url);
    }

    public function getReturnToUrl(): ?string
    {
        return $this->get(SessionConstants::RETURN_TO_URL_KEY);
    }

    public function resolveReturnToUrl(): string
    {
        $returnToUrl = $this->getReturnToUrl() ?? PageConstants::HOME_PAGE;
        $returnToPath = parse_url($returnToUrl, PHP_URL_PATH) ?: '';

        // Prevent users from being redirected to the registration page after successfully logging in
        if ($returnToPath === PageConstants::CREATE_ACCOUNT_PAGE) {
            $returnToUrl = PageConstants::HOME_PAGE;
        }

        return $returnToUrl;
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * @param array{
     *     cart: array<int, array{
     *         id: int,
     *         category: string,
     *         subcategory: string,
     *         groupCode: string,
     *         groupName: string,
     *         color: string,
     *         size: string,
     *         price: float,
     *         quantity: int
     *     }>
     * } $payload
     */
    public function save(array $payload): void
    {
        $userId = self::get(SessionConstants::USER_ID_KEY);
        if ($userId === null) {
            return;
        }

        try {
            $json = json_encode($payload, JSON_THROW_ON_ERROR);
            $this->accountRepository->saveSession($userId, $json);
        } catch (JsonException $e) {
            error_log("Failed to encode session JSON for user {$userId}: " . $e->getMessage());
        }
    }

    public function restore(CartService $cartService): void
    {
        $userId = self::get(SessionConstants::USER_ID_KEY);
        if ($userId === null) {
            return;
        }

        $row = $this->accountRepository->findSessionByUserId($userId);
        $blob = $row[DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD] ?? null;

        if (!$blob) {
            return;
        }

        try {
            $data = json_decode($blob, true, 512, JSON_THROW_ON_ERROR);

            if (isset($data['cart']) && is_array($data['cart'])) {
                $cartService->setCartFromArray($data['cart']);
            }
        } catch (JsonException $e) {
            error_log("Failed to decode session JSON for user {$userId}: " . $e->getMessage());
        }
    }

    /**
     * Removes the session data from memory, deletes the session cookie
     * if a session is active, and destroys the session storage.
     */
    public function destroy(): void
    {
        $sessionName = session_name();

        if ($sessionName !== false) {
            $cookieParams = session_get_cookie_params();

            setcookie(
                $sessionName,
                '',
                [
                    'expires'  => 0,
                    'path'     => $cookieParams['path'],
                    'domain'   => $cookieParams['domain'],
                    'secure'   => $cookieParams['secure'],
                    'httponly' => $cookieParams['httponly'],
                    'samesite' => $cookieParams['samesite'],
                ]
            );
        }

        $_SESSION = [];
        session_destroy();
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }
}
