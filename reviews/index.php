<?php

// REVIEWS CONTROLLER

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// get the reviews-model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';
// get the vehicles-model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';


// create or access a session
session_start();

$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  // add a new review
  case 'addReview':
    $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
    $reviewText = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    // var_dump($invId);
    // echo '<br>';
    // var_dump($clientId);
    // exit;

    if (empty($reviewText)) {
      $_SESSION['message'] = '<p class="message">Please provide all of the required information for the vehicle you would like to add.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
      exit;
    };

    $reviewOutcome = insertReview($reviewText, $invId, $clientId);

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
    break;

  // deliver a view to edit a review
  case 'editReview':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
    break;

  // handle the review update
  case 'reviewEdited':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
    break;

  // deliver a view to confirm deletion of a review
  case 'deleteReview':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
    break;

  // handle the review deletion
  case 'reviewDeleted':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
    break;

  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
}

?>