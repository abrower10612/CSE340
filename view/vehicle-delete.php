<?php
if($_SESSION['clientData']['clientLevel'] < 2) {
  header('Location: /phpmotors/index.php');
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
  <title>
    <?php 
      if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){
        echo "Delete $invInfo[invMake] $invInfo[invModel]";
      } 
    ?>
   | PHP Motors</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <section class="addVehicle">
    <h1>
      <?php
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
          echo "Delete $invInfo[invMake] $invInfo[invModel]";
        }
      ?>
    </h1>
    <?php
    if (isset($message)) {
      echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/vehicles/index.php" id="addVehicleForm">
      <fieldset>
        <label for="invMake">Make*<input type="text" readonly name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";}?>></label>

        <label for="invModel">Model*<input type="text" readonly name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'";}?>></label>

        <label for="invDescription">Description*<input type="text" readonly name="invDescription" id="invDescription" <?php if(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'";}?>></label>

        <input type="submit" class="addButton" name="submit" id="addButton" value="Delete Vehicle">
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>
</html>
<?php unset($_SESSION['message']); ?>