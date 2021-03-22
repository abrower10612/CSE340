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
  <title>PHP Motors | Home</title>
</head>

<body class="home">
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
  <h1>Welcome to PHP Motors!</h1>
  <h2>DMC Delorean</h2>
  <p id="features">3 Cup Holders<br>Superman Doors<br>Fuzzy Dice!</p>
  <div class="buttondiv">
    <button class="buttonLarge">Own Today</button>
  </div>
  <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Image of a Delorean car" class="delorean">
  <div class="buttondiv">
    <button class="buttonSmall">Own Today</button>
  </div>
  <section class="deloreanInfo">
    <div class="reviews">
      <h3>DMC Delorean Reviews</h3>
      <ul>
        <li>"So fast it's almost like traveling in time." [4/5]</li>
        <li>"Coolest ride on the road." [4/5]</li>
        <li>"I'm feeling Marty McFly!" [5/5]</li>
        <li>"The most futuristic ride of our day." [4/5]</li>
        <li>80's livin and I love it!" [5/5]</li>
      </ul>
    </div>
    <div class="upgradeInfo">
      <h3>Delorean Upgrades</h3>
      <div class="upgrades">
        <div class="upgrade1">
          <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Image of a flux capacitor found within a Delorean"><br>
          <a href="#">Flux Capacitor</a>
        </div>
        <div class="upgrade2">
          <img src="/phpmotors/images/upgrades/flame.png" alt="Image of a flame decal"><br>
          <a href="#">Flame Decals</a>
        </div>
        <div class="upgrade3">
          <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Image of a bumper sticker that reads 'Hello World'"><br>
          <a href="#">Bumper Stickers</a>
        </div>
        <div class="upgrade4">
          <img src="/phpmotors/images/upgrades/hubcap.png" alt="Image of a silver hub cap"><br>
          <a href="#">Hub Caps</a>
        </div>
      </div>
    </div>
  </section>
  <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
</body>

</html>