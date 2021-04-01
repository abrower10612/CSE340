<?php

// REVIEWS CONTROLLER

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// get the vehicles-model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';


if (!isset($_SESSION)) {
  // create or access a session
  session_start();
}

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

    if (empty($reviewText)) {
      $_SESSION['message'] = '<p class="message">Please provide all of the required information for the vehicle you would like to add.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
      exit;
    }

    $reviewOutcome = insertReview($reviewText, $invId, $clientId);

    header('location: /phpmotors/vehicles?action=getVehicleInfo&invId=' . $invId);
    
    break;


  // deliver a view to edit a review
  case 'editReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $specificReview = getSpecificReview($reviewId);

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
    break;

  // handle the review update
  case 'reviewEdited':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $specificReview = getSpecificReview($reviewId);
    if (empty($reviewText)) {
      $message = '<p class="message" id="redMessage">The review cannot be left blank. Please fill in the review before submitting.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
      exit;
    }

    $reviewUpdateResult = updateReview($reviewText, $reviewId);

    if (!$reviewUpdateResult) {
      $message = '<p class="message" id="redMessage">Review update failed. Please try again.</p>';
      $_SESSION['message'] = $message;
    }
    $message = '<p class="message" id="greenMessage">Your review has been successfully updated.</p>';
    $_SESSION['message'] = $message;

    header('Location: /phpmotors/reviews/index.php');
    break;

  // deliver a view to confirm deletion of a review
  case 'deleteReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $message = '<p id="redMessage">Are you sure you want to delete this review?</p>';
    $_SESSION['message'] = $message;

    $specificReview = getSpecificReview($reviewId);

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-delete.php';
    break;

  // handle the review deletion
  case 'reviewDeleted':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $deleteUpdateResult = deleteReview($reviewId);

    if (!$deleteUpdateResult) {
      $message = '<p class="message" id="redMessage">Review couldn\'t be deleted. Please try again.</p>';
      $_SESSION['message'] = $message;
      header('Location: /phpmotors/reviews/index.php');
      exit;
    }
    $message = '<p class="message" id="greenMessage">Your review has been successfully deleted.</p>';
    $_SESSION['message'] = $message;
    
    header('Location: /phpmotors/reviews/index.php');
    break;

  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
    break;
}

?>