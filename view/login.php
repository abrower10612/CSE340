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
  <title>PHP Motors | Login</title>
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <section class="login">
    <h1>Log in</h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
    ?>
    <form method="post" action="/phpmotors/accounts/">
      <fieldset>
        <label for="clientEmail">Email Address *<input type="email" name="clientEmail" id="clientEmail" <?php if (isset($clientEmail)) {echo "value='$clientEmail'";} ?> required></label>

        <label for="clientPassword">Password *<input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="clientPassword" required><span>Password must contain at least 8 characters, 1 uppercase, 1 number, and 1 special character.</span></label>

        <input type="submit" name="submit" class="loginButton" value="Log in">
        <input type="hidden" name="action" value="loginUser">

        <a href="">Forgot password? </a><br><br>
        <a href="/phpmotors/accounts/index.php?action=register">Not a member?</a>
      </fieldset>
    </form>
  </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>