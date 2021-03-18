<?php
  if($_SESSION['clientData']['clientLevel'] < 2)
    header('Location: /phpmotors/index.php');
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
  <title>PHP Motors | Add Classification</title>
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

  <section class="addClassification">
    <h1>Add a Car Classification</h1>
    <?php
    if (isset($message)) {
      echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/vehicles/index.php" id="addClassificationForm">
      <fieldset>
        <label for="classificationName">Classification Name*<input type="text" name="classificationName" id="classificationName" required></label>

        <input type="submit" class="addButton" name="submit" id="addButton" value="Add Classification">
        <input type="hidden" name="action" value="classificationAdded">

      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>