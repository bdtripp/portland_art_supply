<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Config\SecurityConstants;
use PAS\Support\RequestHelper;
use PAS\Exceptions\CsrfException;

/**
 * Provides CSRF protection for form submissions.
 *
 * This service manages the full CSRF token lifecycle:
 * - generating cryptographically secure tokens
 * - storing tokens in the session (the SSOT)
 * - retrieving tokens for form rendering
 * - validating submitted tokens
 * - enforcing CSRF protection via guard()
 *
 * The guard() method throws a CsrfException if validation fails.
 */
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

    /**
     * Enforces CSRF protection for state‑changing requests.
     *
     * Validates the incoming token and throws an exception on failure,
     * allowing the front controller to manage the HTTP response.
     *
     * @throws CsrfException When the CSRF token is missing or invalid.
     */
    public function guard(RequestHelper $requestHelper): void
    {
        $token = $requestHelper->getPostString(SecurityConstants::CSRF_TOKEN_KEY);

        if (!$this->validate($token)) {
            throw new CsrfException('Invalid CSRF token');
        }
    }
}
