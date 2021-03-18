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
  <title>PHP Motors | Admin</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <main class="admin">
    <?php
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
      } 
    ?>
    <h1>
      <?php 
        echo $_SESSION['clientData']['clientFirstname'];
        echo ' '; 
        echo $_SESSION['clientData']['clientLastname']
      ?>
    </h1>
    <h3>You are logged in.</h3>
    <ul>
      <li>
        First Name:
        <?php 
          echo $_SESSION['clientData']['clientFirstname'] 
        ?>
      </li>
      <li>
        Last Name:
        <?php 
          echo $_SESSION['clientData']['clientLastname']
        ?>
      </li>
      <li>
        Email Address:
        <?php 
          echo $_SESSION['clientData']['clientEmail']
        ?>
      </li>
    </ul>

    <h2>Account Management</h2>
    <p>Use this link to update account information:</p>
    <a href="/phpmotors/accounts/index.php?action=accountMod">Update Account Information</a>

    <?php
      if($_SESSION['clientData']['clientLevel'] > 1) {
        echo '<h2>Inventory Management</h2>';
        echo '<p>Use this link to update vehicle information:</p>';
        echo '<p><a href="/phpmotors/vehicles">Vehicle Management</a>';
      }
    ?>
  </main>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>  
</body>
</html>
