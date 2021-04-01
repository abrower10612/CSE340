<?php 
  if($_SESSION['clientData']['clientLevel'] < 2)
    header('Location: /phpmotors/index.php');

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
      } elseif(isset($invInfo['classificationId'])) {
        if($classification['classificationId'] === $invInfo['classificationId']){
          $classificationList .= ' selected ';
        }
      }
      $classificationList .= ">$classification[classificationName]</option>";
  }
  $classificationList .= '</select></label>';

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
        echo "Modify $invInfo[invMake] $invInfo[invModel]";
      } 
      elseif(isset($invMake) && isset($invModel)) {
        echo "Modify $invMake $invModel";  
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
          echo "Modify $invInfo[invMake] $invInfo[invModel]";
        }
        elseif (isset($invMake) && isset($invModel)) {
          echo "Modify $invMake $invModel";
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
        <label for="invMake">Make* 
          <input type="text" name="invMake" id="invMake" 
            <?php 
              if (isset($invMake)) {
                echo "value='$invMake'";
              } 
              elseif(isset($invInfo['invMake'])) {
                echo "value='$invInfo[invMake]'";
              } 
            ?> 
          required>
        </label>

        <label for="invModel">Model* <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)) {echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?> required></label>

        <label for="invDescription">Description* <input type="text" name="invDescription" id="invDescription" <?php if (isset($invDescription)) {echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'";} ?> required></label>

        <label for="invImage">Image*<input type="text" name="invImage" id="invImage" value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) {echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'";} ?> required></label>

        <label for="invThumbnail">Thumbnail*<input type="text" name="invThumbnail" id="invThumbnail" value="/phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'";} ?> required></label>

        <label for="invPrice">Price*<input type="number" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?> required></label>

        <label for="invStock">Stock*<input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?> required></label>

        <label for="invColor">Color*<input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?> required></label>

        <?php echo $classificationList ?>

        <input type="submit" class="addButton" name="submit" id="addButton" value="Update Vehicle">
        <input type="hidden" name="action" value="updateVehicle">
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">

      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>