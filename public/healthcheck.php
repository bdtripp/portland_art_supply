<?php

/**
 * Lightweight healthcheck endpoint.
 *
 * This file is intentionally minimal. It allows Docker (or any external
 * monitoring system) to verify that the PHP runtime and web server are
 * responding without loading the full application stack.
 *
 * Design choice:
 * - We do NOT include autoloaders, sessions, or any application
 * code. This ensures the healthcheck remains fast, reliable, and
 * independent of database availability or business logic.
 */

http_response_code(200);
echo 'OK';
