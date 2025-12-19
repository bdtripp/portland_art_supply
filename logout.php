<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/11/2018
 * Time: 9:50 AM
 */
session_start();

require_once('includes/utilities.php');
require_once('includes/page_constants.php');

$returnToUrl = $_SERVER['HTTP_REFERER'];

session_start();
destroy_session();
header('Location: ' . $returnToUrl);