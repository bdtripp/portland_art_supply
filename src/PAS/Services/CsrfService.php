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
        private SessionManager $sessionManager
    ) {
    }

    public function getToken(): ?string
    {
        $stored = $this->sessionManager->get(self::SESSION_KEY);

        return is_string($stored) ? $stored : null;
    }

    /**
     * @phpstan-assert-if-true string $token
     */
    private function isNonEmptyString(?string $token): bool
    {
        return is_string($token) && $token !== '';
    }

    public function validate(?string $token): bool
    {
        $stored = $this->getToken();

        if (!$this->isNonEmptyString($stored) || !$this->isNonEmptyString($token)) {
            return false;
        }

        return hash_equals($stored, $token);
    }

    private function createAndStoreToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $this->sessionManager->set(self::SESSION_KEY, $token);
        return $token;
    }

    public function getOrCreateToken(): string
    {
        $token = $this->getToken();

        if (!$this->isNonEmptyString($token)) {
            $token = $this->createAndStoreToken();
        }

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
