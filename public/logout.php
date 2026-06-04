<?php
require_once __DIR__ . '/../config.php';
session_start();

use PAS\Utilities;

$returnToUrl = $_SERVER['HTTP_REFERER'];

Utilities::destroySession();
header('Location: ' . $returnToUrl);