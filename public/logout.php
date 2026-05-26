<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
use PAS\Utilities;

$returnToUrl = $_SERVER['HTTP_REFERER'];

Utilities::destroySession();
header('Location: ' . $returnToUrl);