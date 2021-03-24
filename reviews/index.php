<?php

// REVIEWS CONTROLLER

// get the reviews-model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';

$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  // add a new review
  case 'addReview':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
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