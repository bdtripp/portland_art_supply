<?php

require_once __DIR__ . '/../../../config.php';

use PAS\Services\SessionService;
use PAS\Infrastructure\Database;
use PAS\Repositories\AccountDataRepository;
use PAS\Config\PageConstants;
use PAS\Config\SecurityConstants;

$db = new Database();
$accountDataRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountDataRepo);
$sessionService->destroy();
$returnToUrl = $_SERVER['HTTP_REFERER'] ?? PageConstants::HOME_PAGE;

foreach (SecurityConstants::ALLOWED_BASE_URLS as $base) {
    if (str_starts_with($returnToUrl, $base)) {
        $returnToUrl = substr($returnToUrl, strlen($base));
        break;
    }
}

if (!str_starts_with($returnToUrl, '/')) {
    $returnToUrl = PageConstants::HOME_PAGE;
}

header('Location: ' . $returnToUrl);
exit;
