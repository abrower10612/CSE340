<?php

// create or access a session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
// Get the reviews model
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';


// call the navList function found in functions.php
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'login':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
    break;

  case 'register':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
    break;

  case 'registerUser':

    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

    $clientEmail = checkEmail($clientEmail);

    $checkPassword = checkPassword($clientPassword);

    // checking for an existing email address
    $existingEmail = checkExistingEmail($clientEmail);

    // if email already exists, provide message telling user
    if ($existingEmail) {
      $_SESSION['message'] = '<p class="notice"> The email address you entered already exists in the system. Use a different email or try logging in instead.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
      exit;
    }
  
    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
      exit;
    }

    //hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
      exit;
    }
    break;

  case 'loginUser':
    // Filter and store the data
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if (empty($clientEmail) || empty($clientPassword)) {
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
      exit;
    } 

    // if a valid password exists, proceed with the login process
    // and query the client data based on the email address
    $clientData = getClient($clientEmail);

    // compare the password just submitted against the hashed
    // password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

    // if the hashes don't match, create an error
    // and return to the login view
    if(!$hashCheck) {
      $_SESSION['message'] = '<p class="notice">Login failed. Please check your email and password and try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
      exit;
    }

    // if a valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;

    // remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);

    // store the array into the session
    $_SESSION['clientData'] = $clientData;

    // send them to the admin view
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
    break;

  case 'admin':

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
    break;

  case 'logout':
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/index.php';
    exit;

  case 'accountMod':
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
    break;

  case 'updateAccount':
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $clientEmail = checkEmail($clientEmail);

    // checking for an existing email address
    $existingEmail = checkExistingEmail($clientEmail);

    // if email already exists, provide message telling user
    if ($_SESSION['clientData']['clientEmail'] !== $clientEmail) {
      if ($existingEmail) {
        $_SESSION['message'] = '<p class="notice"> The email address you entered already exists in the system. Pleaes try a different email address.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
        exit;
      }
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $message = '<p class="message" id="redMessage">Please fill in missing required input with the proper format.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
      exit;
    }

    // Send the data to the model
    $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

    $clientData = getClient($clientEmail);

    $_SESSION['clientData'] = $clientData;

    // // Check and report the result
    if ($updateResult) {
      $message = '<p class="message" id="greenMessage"> Account successfully updated.</p>';
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/');
      exit;
    } else {
      $message = '<p class="message" id="redMessage">Account update failed. Please make a change to one of the following fields.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
      exit;
    }
    break;

  case 'updatePassword':
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $checkPassword = checkPassword($clientPassword);
    
    if ($checkPassword === 0) {
      $message = '<p class="message" id="redMessage">Invalid password. Please make sure your new password meets all the requirements.</p>';
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
      exit;
    }

    // Check for missing data
    if (empty($checkPassword)) {
      $_SESSION['message'] = '<p id="redMessage">Please enter a new password.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
      exit;
    }

    //hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $passwordOutcome = updatePassword($hashedPassword, $clientId);

    // Check and report the result
    if ($passwordOutcome === 1) {
      // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p>Your password was successfully updated.</p>";
      header('Location: /phpmotors/accounts');
      exit;
    } else {
      $_SESSION['message'] = "<p>Password update failed. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
      exit;
    }

  default:
    include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
    break;
}

?>