<?php
  if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/index.php');
  }
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/phpmotors/css/small.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/phpmotors/css/large.css?v=<?php echo time(); ?>">
  <title>PHP Motors | Update Your Account</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <section class="clientUpdate">
    <h1>
      <?php
        if(isset($_SESSION['clientData']['clientLastname']) && isset($_SESSION['clientData']['clientLastname'])) {
          echo "Account Settings: ";
          echo $_SESSION['clientData']['clientFirstname'] ;
          echo " ";
          echo $_SESSION['clientData']['clientLastname'];
        }
        elseif (isset($invMake) && isset($invModel)) {
          echo "Modify $invMake $invModel";
        }
      ?>
    </h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="/phpmotors/accounts/index.php">
      <fieldset>
        <legend>Update Account Information</legend>
        <label for="clientFirstname">First Name*</label>
        <input type="text" name="clientFirstname" id="clientFirstname" 
          <?php 
            if (isset($_SESSION['clientData']['clientFirstname'])) {
              echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'";
            }
          ?> 
        required>

        <label for="clientLastname">Last Name*</label>
          <input type="text" name="clientLastname" id="clientLastname" 
            <?php 
              if (isset($_SESSION['clientData']['clientLastname'])) {
                echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";
              }
            ?> 
          required>

        <label for="clientEmail">Email*</label>
          <input type="email" name="clientEmail" id="clientEmail" 
            <?php 
              if (isset($_SESSION['clientData']['clientLastname'])) {
                echo "value='" . $_SESSION['clientData']['clientEmail'] . "'";
              }
            ?> 
          required>

        <input type="submit" class="addButton" name="submit" value="Update Account">

        <input type="hidden" name="action" value="updateAccount">

        <input type="hidden" name="clientId" value="
          <?php 
            if(isset($_SESSION['clientData']['clientId'])){
              echo $_SESSION['clientData']['clientId'];
            } 
            elseif(isset($clientId)) {
               echo $clientId; 
            } 
          ?>
        ">
      </fieldset>
    </form>
    <!-- Password update form -->
    <form method="post" action="/phpmotors/accounts/index.php">
      <fieldset>
        <legend>Change Password</legend>
        <label for="clientPassword">New Password*</label><input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="clientPassword" required>
        <span>Password must contain at least 8 characters, 1 uppercase, 1 number, and 1 special character.</span><br>
        <span>Please take note that after clicking the button below, your password will be changed to the new password you have entered above.</span>

        <input type="submit" class="addButton" name="submit" value="Update Password">

        <input type="hidden" name="action" value="updatePassword">

        <input type="hidden" name="clientId" value="
          <?php 
            if(isset($_SESSION['clientData']['clientId'])){
              echo $_SESSION['clientData']['clientId'];
            } 
            elseif(isset($clientId)) {
               echo $clientId; 
            } 
          ?>
        ">
      </fieldset>
    </form>
  </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>  
</body>
</html>
