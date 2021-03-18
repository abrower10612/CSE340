<?php 
//build the select list
$classificationList = '<label for="classificationId">Classification*<br>' 
. '<select name="classificationId" id="classificationId" required>'
. '<option value="">Select a car classification</option>'; 
foreach ($classifications as $classification) { 
  $classificationList .= "<option value='$classification[classificationId]'"; 
    if(isset($classificationId)) {
      if($classification['classificationId'] === $classificationId) {
        $classificationList .= ' selected ';
      }
    }
    $classificationList .= ">$classification[classificationName]</option>";

}
$classificationList .= '</select></label>';

?><?php
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
  <title>PHP Motors | Add Vehicle</title>
</head>

<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

  <section class="addVehicle">
    <h1>Add a Vehicle</h1>
    <?php
    if (isset($message)) {
      echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/vehicles/" id="addVehicleForm">
      <fieldset>
        <label for="invMake">Make* <input type="text" name="invMake" id="invMake" <?php if (isset($invMake)) {echo "value='$invMake'";} ?> required></label>

        <label for="invModel">Model* <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)) {echo "value='$invModel'";} ?> required></label>

        <label for="invDescription">Description* <input type="text" name="invDescription" id="invDescription" <?php if (isset($invDescription)) {echo "value='$invDescription'";} ?> required></label>

        <label for="invImage">Image*<input type="text" name="invImage" id="invImage" value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) {echo "value='$invImage'";} ?> required></label>

        <label for="invThumbnail">Thumbnail*<input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} ?> required></label>

        <label for="invPrice">Price*<input type="number" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {echo "value='$invPrice'";} ?> required></label>

        <label for="invStock">Stock*<input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {echo "value='$invStock'";} ?> required></label>

        <label for="invColor">Color*<input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {echo "value='$invColor'";} ?> required></label>

        <?php echo $classificationList ?>

        <input type="submit" class="addButton" name="submit" id="addButton" value="Add Vehicle">
        <input type="hidden" name="action" value="vehicleAdded">

      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>