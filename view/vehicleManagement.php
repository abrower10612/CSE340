<?php
  if($_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
    exit;
  }
  if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
  <title>PHP Motors | Vehicle Management</title>
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <?php
  if (isset($message)) {
    echo $message;
  }
  ?>
  <section class="vehiclemgmt">
    <h1>Vehicle Management</h1>
    <a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a><br>
    <a href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a>
    <?php
      if (isset($classificationList)) { 
        echo '<h2>Vehicles By Classification</h2>'; 
        echo '<p>Choose a classification to see those vehicles</p>'; 
        echo $classificationList; 
      }
    ?>
    <noscript>
      <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>
  </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>