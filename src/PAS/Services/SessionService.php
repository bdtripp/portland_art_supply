<?php

declare(strict_types=1);

namespace PAS\Services;

use JsonException;
use PAS\Models\CartItem;
use PAS\Repositories\AccountDataRepository;
use PAS\Support\Utilities;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;

final class SessionService
{
    public function __construct(
        private AccountDataRepository $accountRepo
    ) {
    }
    public function setUser(int $id, string $username): void
    {
        Utilities::setSessionValue(PageConstants::SESSION_USER_ID_KEY, $id);
        Utilities::setSessionValue(PageConstants::SESSION_USERNAME_KEY, $username);
    }

    public function setReturnToUrl(string $url): void
    {
        Utilities::setSessionValue(PageConstants::SESSION_RETURN_TO_URL, $url);
    }

    public function getReturnToUrl(): ?string
    {
        return Utilities::getSessionValue(PageConstants::SESSION_RETURN_TO_URL);
    }

    public function save(): void
    {
        $userId = Utilities::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
        if ($userId === null) {
            return;
        }

        $items = Utilities::getCartItems();

        $payload = [
            'cart' => array_map(fn (CartItem $item) => $item->toArray(), $items),
        ];

        try {
            $json = json_encode($payload, JSON_THROW_ON_ERROR);
            $this->accountRepo->saveSession($userId, $json);
        } catch (JsonException $e) {
            error_log("Failed to encode session JSON for user {$userId}: " . $e->getMessage());
        }
    }

    public function restore(): void
    {
        $userId = Utilities::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
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
                $items = array_map(
                    fn ($arr) => CartItem::fromArray($arr),
                    $data['cart']
                );

                Utilities::setCartItems($items);
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
}
