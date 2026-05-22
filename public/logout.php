<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/11/2018
 * Time: 9:50 AM
 */
session_start();

require_once __DIR__ . '/../config.php';
use PAS\Utilities;
use PAS\PageConstants;

$returnToUrl = $_SERVER['HTTP_REFERER'];

destroy_session();
header('Location: ' . $returnToUrl);