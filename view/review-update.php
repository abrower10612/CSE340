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
    <h1>Update Your Review</h1>
    <?php
    if (isset($message)) {
      echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/reviews/index.php" id="addVehicleForm">
      <fieldset>

        <label for="reviewDate">Review Date:
          <input type="text" name="reviewDate" id="reviewDate" 
          <?php 
            if (isset($specificReview)) {
              echo "value='"
              . date('m/d/y', strtotime($specificReview['reviewDate']))
              . "'";
            } 
          ?> disabled>
        </label>

        <label for="invModel">Screen Name:
          <input type="text" name="invModel" id="invModel" 
          <?php 
            if (isset($specificReview)) {
              echo "value='"
              . substr($specificReview['clientFirstname'], 0, 1)
              . substr($specificReview['clientLastname'], 0)
              . "'";
            } 
          ?> disabled>
        </label>

        <label for="reviewText">Review:<br>
          <textarea type="text" name="reviewText" id="reviewText" id="reviewTextUpdate"required><?php if (isset($specificReview)) {echo $specificReview['reviewText'];}?></textarea>
        </label>

        <input type="submit" class="addButton" id="addButton"  name="submit" value="Update Review">
        <input type="hidden" name="action" value="reviewEdited">
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">

      </fieldset>
    </form>
  </section>

  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>