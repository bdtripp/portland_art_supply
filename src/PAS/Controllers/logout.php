<?php

require_once __DIR__ . '/../../../config.php';

use PAS\Support\Utilities;

$returnToUrl = $_SERVER['HTTP_REFERER'];

Utilities::destroySession();
header('Location: ' . $returnToUrl);
