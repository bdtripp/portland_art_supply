<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Config\SecurityConstants;
use PAS\Support\RequestHelper;

final class CsrfService
{
    private const SESSION_KEY = 'csrf_token';

    public function __construct(
        private SessionService $session
    ) {
    }

    public function getToken(): string
    {
        $token = $this->session->get(self::SESSION_KEY);

        if (!$this->isValidToken($token)) {
            $token = $this->generateAndStoreToken();
        }

        return $token;
    }

    public function validate(?string $token): bool
    {
        $stored = $this->session->get(self::SESSION_KEY);

        if (!is_string($stored) || !is_string($token)) {
            return false;
        }

        if ($stored === '' || $token === '') {
            return false;
        }
        return hash_equals($stored, $token);
    }

    private function isValidToken(mixed $token): bool
    {
        return is_string($token) && $token !== '';
    }

    private function generateAndStoreToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $this->session->set(self::SESSION_KEY, $token);
        return $token;
    }

    public function guard(RequestHelper $requestHelper): void
    {
        $token = $requestHelper->getPost(SecurityConstants::CSRF_TOKEN_KEY);

        if (!$this->validate($token)) {
            http_response_code(400);
            exit('Invalid CSRF token');
        }
    }
}
