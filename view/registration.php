<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/phpmotors/css/small.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="/phpmotors/css/large.css?v=<?php echo time(); ?>">
  <title>PHP Motors | Create New Account</title>
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

  <section class="register">
    <h1>Create Your Account</h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="/phpmotors/accounts/index.php">
      <fieldset>
        <label for="clientFirstname">First Name *<input type="text" name="clientFirstname" id="clientFirstname" <?php if (isset($clientFirstname)) {echo "value='$clientFirstname'";} ?> required></label>

        <label for="clientLastname">Last Name *<input type="text" name="clientLastname" id="clientLastname" <?php if (isset($clientLastname)) {echo "value='$clientLastname'";} ?> required></label>

        <label for="clientEmail">Email Address *</label><input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required>

        <label for="clientPassword">Password *<input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="clientPassword" required><span>Password must contain at least 8 characters, 1 uppercase, 1 number, and 1 special character.</span></label>

        <input type="submit" class="registerButton" name="submit" id="regbtn" value="Register">
        <input type="hidden" name="action" value="registerUser">

        <a href="/phpmotors/accounts/index.php?action=login">Already registered?</a>
      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>
</html>