<header>
  <div class="container" onclick="myFunction(this)">
    <div class="bar1"></div>
    <div class="bar2"></div>
    <div class="bar3"></div>
  </div>
  <img src="/phpmotors/images/site/logo.png" id="logo" alt="Image of the PHP Motors logo">
  <?php
    if(isset($_SESSION['clientData'])) {
      echo '<a href="/phpmotors/accounts/index.php?action=admin" id="welcome">Welcome ';
      echo $_SESSION["clientData"]["clientFirstname"];
      echo '</a>';
    }
  ?>
  <?php
  if(isset($_SESSION['loggedin'])) 
    echo "<a href='/phpmotors/accounts/index.php?action=logout' class='myAccount'>Logout</a>";
  else 
    echo "<a href='/phpmotors/accounts/index.php?action=login' class='myAccount'>My Account</a>";
  ?>
  <script>
    function myFunction(x) {
      document.querySelector('nav').classList.toggle("hide");
      x.classList.toggle("change");
    }
  </script>
</header>