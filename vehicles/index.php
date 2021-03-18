<?php

// create or access a session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the vehicle model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// call the navList function found in functions.php
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'addClassification':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/addClassification.php';
    break;

  case 'addVehicle':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/addVehicle.php';
    break;

  case 'classificationAdded':
    // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName');

    // Check for missing data
    if (empty($classificationName)) {
      $message = '<p  class="message">Please provide all of the required information for the classification you would like to add.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/addClassification.php';
      exit;
    }

    // Send the data to the model
    $invOutcome = newClassification($classificationName);

    // Check and report the result
    if ($invOutcome === 1) {
      $message = "<p class='message'>Classification was successfully added.</p>";
      header('Location: /phpmotors/vehicles/index.php');
      exit;
    } else {
      $message = "<p class='message'>Classification addition failed. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicleManagement.php';
      exit;
    }
    break;

  case 'vehicleAdded':
    // Filter and store the data
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

    // Check for missing data
    if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
      $_SESSION['message'] = '<p class="message">Please provide all of the required information for the vehicle you would like to add.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/addVehicle.php';
      exit;
    }

    // Send the data to the model
    $invOutcome = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

    // Check and report the result
    if ($invOutcome === 1) {
      $message = '<p class="message">' . $invMake . ' ' . $invModel . ' successfully added.</p>';
      $_SESSION['message'] = $message;
      header('Location: /phpmotors/vehicles');
      exit;
    } else {
      $message = "<p class='message'>Vehicle addition failed. Please try again.</p>";
      $_SESSION['message'] = $message;
      header('Location: /phpmotors/vehicles');
      exit;
    }
    break;

  // Used for starting update & delete process of vehicles by classificationId
  case 'getInventoryItems': 
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
    break;

  case 'updateVehicle':
    // Filter and store the data
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    // Check for missing data
    if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
      $message = '<p class="message">Please complete all information for the vehicle! Double check the classification of the item.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/addVehicle.php';
      exit;
    }

    // Send the data to the model
    $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

    // Check and report the result
    if ($updateResult) {
      $message = '<p class="message">' . $invMake . ' ' . $invModel . ' successfully updated.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } 
    else {
      $message = '<p class="message">Vehicle update failed. Please try again.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
      exit;
    }
    break;

  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo) < 1) {
      $message = '<p class="message">Sorry, no vehicle information could be found</p>';
      $_SESSION['message'] = $message;
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
    break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo) < 1) {
      $message = '<p class="message">Sorry, no vehicle information could be found</p>';
    }
    $message = '<p class="message">This action is permanent. Are you sure you want to delete this ' . $invInfo['invMake'] . ' ' . $invInfo['invModel'] .'?</p>';
    $_SESSION['message'] = $message;
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-delete.php';
    exit;
    break;

  case 'deleteVehicle':
    // Filter and store the data
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    // Send the data to the model
    $deleteResult = deleteVehicle($invId);

    // Check and report the result
    if ($deleteResult) {
      $message = '<p class="message">' . $invMake . ' ' . $invModel . ' successfully deleted.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = '<p class="message">' . $invMake . ' ' . $invModel . ' failed to be deleted. Please try again. </p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
    break;

  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING); // to filter, sanitize, and store the second value being sent through the URL
    $vehicles = getVehiclesByClassification($classificationName); // variable for storing the array of vehicles that is returned from the vehicles model.
    if(!count($vehicles)) {
      $message = '<p class="notice">Sorry, no ' . $classificationName . ' vehicles could be found.</p>';
      $_SESSION['message'] = $message;
    }
    else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php'; // deliver either the message or the vehicles belonging to the selected classification from menu
    break;

  case 'getVehicleInfo':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    if($invId < 1) {
      $message = '<p class="notice">Sorry, no vehicle information could be found for your selection</p>';
      $_SESSION['message'] = $message;
    }
    $getVehicleInfo = getInvItemInfo($invId);
    $vehicleInfo = vehicleInfo($getVehicleInfo);
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
    break;

  default:
    $classificationList = buildClassificationList($classifications);
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicleManagement.php';
    break;
}
?>