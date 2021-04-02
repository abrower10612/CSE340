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
  <title><?php echo $vehicleInfo['invMake'] . " " . $vehicleInfo['invModel'] ?> | PHP Motors</title>
</head>
<body>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
    ?>
    <?php
      if (isset($buildView)) {
        echo $buildView;
      }
    ?>
    <section class="reviewsContainer">
      <h2>Customer Reviews</h2>
      <?php
          if (isset($_SESSION['loggedin'])) {
            echo $reviewSection;
          }
          else {
            echo '<p>You must <a href="/phpmotors/accounts/index.php?action=login">login</a> to write a review';
          }

          if (!$vehicleReviews) {
            echo '<p id="greenMessage">Be the first to write a review!</p>';
          }
          else {
            echo '<section id=postedReviews>';
            foreach ($vehicleReviews as $review) {
              echo '<section id="reviews">';
              echo '<p>On '
              . date('m/d/y', strtotime($review['reviewDate']))
              . ', '
              . substr($review['clientFirstname'], 0, 1)
              . substr($review['clientLastname'], 0)
              . ' wrote: </p><br>'
              . '<p>'
              . $review['reviewText']
              . '</p></section>';
            }
            echo '</section';
          }
      ?>
    </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>  
</body>
</html>