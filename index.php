<?php

// create or access a session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// call the navList function found in functions.php
$navList = navList($classifications);

if (isset($_COOKIE['firstname'])) $cookieFirstName = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'template':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
    break;

  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
}

?>