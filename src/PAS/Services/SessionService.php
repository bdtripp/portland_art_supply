<?php

declare(strict_types=1);

namespace PAS\Services;

use JsonException;
use PAS\Repositories\AccountDataRepository;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;
use PAS\Services\CartService;

final class SessionService
{
    public function __construct(
        private AccountDataRepository $accountRepo
    ) {
    }

    public function get(string $key): mixed
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function destroy(): void
    {
        $session_info = session_get_cookie_params();
        $_SESSION = [];
        setcookie(
            (string) session_name(),
            '',
            0,
            $session_info['path'],
            $session_info['domain'],
            $session_info['secure'],
            $session_info['httponly']
        );
        session_destroy();
    }
    public function setUser(int $id, string $username): void
    {
        self::set(PageConstants::SESSION_USER_ID_KEY, $id);
        self::set(PageConstants::SESSION_USERNAME_KEY, $username);
    }

    public function setReturnToUrl(string $url): void
    {
        self::set(PageConstants::SESSION_RETURN_TO_URL, $url);
    }

    public function getReturnToUrl(): ?string
    {
        return self::get(PageConstants::SESSION_RETURN_TO_URL);
    }

    /**
     * @param array{
     *     cart: array<int, array{
     *         productItemId: int,
     *         categoryName: string,
     *         subcategoryName: string,
     *         groupCode: string,
     *         groupDescription: string,
     *         colorName: string,
     *         sizeDescription: string,
     *         price: float,
     *         quantity: int
     *     }>
     * } $payload
     */
    public function save(array $payload): void
    {
        $userId = self::get(PageConstants::SESSION_USER_ID_KEY);
        if ($userId === null) {
            return;
        }

        try {
            $json = json_encode($payload, JSON_THROW_ON_ERROR);
            $this->accountRepo->saveSession($userId, $json);
        } catch (JsonException $e) {
            error_log("Failed to encode session JSON for user {$userId}: " . $e->getMessage());
        }
    }

    public function restore(CartService $cartService): void
    {
        $userId = self::get(PageConstants::SESSION_USER_ID_KEY);
        if ($userId === null) {
            return;
        }

        $row = $this->accountRepo->findSessionByUserId($userId);
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

    public function redirect(?string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }
}
