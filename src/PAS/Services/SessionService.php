<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Config\PageConstants;
use PAS\Support\Utilities;

final class SessionService
{
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
        Utilities::saveSession();
    }

    public function restore(): void
    {
        Utilities::restoreSession();
    }

    public function redirect(?string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
