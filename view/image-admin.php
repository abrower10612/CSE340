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
  <title>Image Management | PHP Motors</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <section class="imgAdmin">
    <?php
      if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
      }
    ?>
      <?php
      if (isset($message)) {
        echo $message;
      }
    ?>
    <h1>Image Management</h1>
    <p>Welcome to the image management page. Choose one of the options presented below:</p>
    <h2>Add New Vehicle Image</h2>
    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
      <label>Vehicle</label>
      <?php echo $prodSelect; ?>
      <fieldset>
        <label>Is this the main image for the vehicle?</label><br>
        <label for="priYes" class="pImage">Yes</label>
        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
        <label for="priNo" class="pImage">No</label>
        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
      </fieldset>
      <div class="uploadBtns">
        <label>Upload Image:</label>
        <input type="file" name="file1" required>
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
      </div>
    </form>
    <hr>
    <h2>Existing Images</h2>
    <p class="notice">If deleting an image, delete the main image and the thumbnail.</p>
    <?php
      if (isset($imageDisplay)) {
        echo $imageDisplay;
      }
    ?>
  </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>  
</body>
</html>
<?php unset($_SESSION['message']); ?>
