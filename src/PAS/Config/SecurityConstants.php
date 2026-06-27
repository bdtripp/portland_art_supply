<?php

declare(strict_types=1);

namespace PAS\Config;

/**
 * Defines the POST key used for CSRF protection and the list of trusted
 * base URLs used to enforce safe redirect behavior.
 */
final class SecurityConstants
{
    public const CSRF_TOKEN_KEY = 'csrf_token';

    public const ALLOWED_BASE_URLS = [
        'http://localhost:8081',
        'https://dev.bdtripp.com',
        'https://bdtripp.com',
    ];
}
