<?php

declare(strict_types=1);

namespace PAS\Config;

/**
 * Session keys used by session service, cart service, and page scripts.
 *
 * These identifiers represent application state stored in the PHP session.
 */
final class SessionConstants
{
    /*
    * Session keys
    */

    public const USER_ID_KEY = 'user_id';
    public const USERNAME_KEY = 'username';
    public const CART_KEY = 'cart';
    public const RETURN_TO_URL_KEY = 'return_to_url';
}
