<?php

require_once __DIR__ . '/../../../config.php';

use PAS\Services\SessionService;
use PAS\Infrastructure\Database;
use PAS\Repositories\AccountDataRepository;

$returnToUrl = $_SERVER['HTTP_REFERER'];

$db = new Database();
$accountDataRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountDataRepo);
$sessionService->destroy();
header('Location: ' . $returnToUrl);
