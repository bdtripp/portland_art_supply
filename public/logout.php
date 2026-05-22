<?php
session_start();

require_once __DIR__ . '/../config.php';
use PAS\Utilities;
use PAS\PageConstants;

$returnToUrl = $_SERVER['HTTP_REFERER'];

destroy_session();
header('Location: ' . $returnToUrl);