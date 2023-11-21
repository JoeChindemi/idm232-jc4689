<!DOCTYPE html>

<html>

<head>
  <title>PHP Main Menu Dynamic</title>
  <link rel="stylesheet" href="./styles/general.css">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <html lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300&family=Nova+Script&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@200;300&family=Nova+Script&display=swap" rel="stylesheet">
</head>

<body>

  <?php

    // $msg = "HOWDY";
    echo '<script type="text/javascript">console.log("'. $msg .'");</script>';

    require_once './includes/fun.php';
    consoleMsg("PHP to JS .. is Wicked FUN");

    // Include env.php that holds global vars with secret info
    require_once './env.php';

    // Include the database connection code
    require_once './includes/database.php';

  ?>


  <!-- <h1>PHP Main Menu Dynamic</h1> -->
<!--
  <div id="content">
    <?php
      // echo "Holla";
      //  $rNum = rand(1, 15);
      //  for ($lp = 0; $lp <= $rNum; $lp++) {
      //     echo "works";

      //    if ($lp % 2 == 0) {
      //      echo "<figure class='oneRec'>";
      //    } else {
      //      echo "<figure class='oneRecOdd'>";
      //    }

      //    echo "<img src='images/0101_FPP_Chicken-Rice_97338_WEB_SQ.png' alt='FPP Chicken Rice'>";
      //    echo "<figcaption>" . $lp . " Ancho-Orange Chicken</figcaption>";
      //    echo "</figure>";
      //  }
    ?>

    <?php
      //Get all the recipes from "recipes" table in the "idm232" database
      $query = "SELECT * FROM recipes";
      $results = mysqli_query($db_connection, $query);
      if ($results->num_rows > 0) {
        consoleMsg("Query successful! number of rows: $results->num_rows");
        while ($oneRecipe = mysqli_fetch_array($results)) {
          // echo '<h3>' .$oneRecipe['Title']. ' - '  . $oneRecipe['Cal/Serving']  .  '</h3>'; 
          $id = $oneRecipe['id'];
          if ($id % 2 == 0) {
            echo '<figure class="oneRec">';
          } else {
            echo '<figure class="oneRecOdd">';
          }
          echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Dish Image">';
          echo '<figcaption>' . $id . ' ' . $oneRecipe['Title'] . '</figcaption>';
          echo '</figure>';
        }

      } else {
        consoleMsg("QUERY ERROR");
      }
    ?>


  </div>
-->

  <header>
    <?php
      echo "<img class='logo' src='./images/smallBannerLogo.png' alt='logo'>";
      echo "<nav class='sample'>";
      echo "<ul class='nav_links'>";
        echo "<li>"; echo "<a href='#'>ALL RECIPES</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>CHICKEN</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>PORK</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>BEEF</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>FISH</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>TURKEY</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>VEGETARIAN</a>"; echo "</li>";
        echo "<li>"; echo "<a href='#'>STEAK</a>"; echo "</li>";
      echo "</nav>";
      echo "<button class='hamburger'>";
        echo "<div class='bar'></div>";
      echo "</button>";
    ?>
  </header>
  <nav class="mobile-nav">
  <?php
      echo "<a href='#'>ALL RECIPES</a>";
      echo "<a href='#'>CHICKEN</a>";
      echo "<a href='#'>PORK</a>";
      echo "<a href='#'>BEEF</a>";
      echo "<a href='#'>FISH</a>";
      echo "<a href='#'>TURKEY</a>";
      echo "<a href='#'>VEGETARIAN</a>";
      echo "<a href='#'>STEAK</a>";
    ?>
  </nav>
  <div class="img-container">
        <div class="inner-container">
        <?php
          echo "<img class='heroImg' src='./images/longBannerLogo.png' alt='header logo'>";
          echo "<p class='heroSubtitle'>Where Flavor Takes Center Stage &dash; Sizzle and Savor the Culinary Journey!</p>";
          echo "<input type='text' placeholder='Search..'>";
          echo "<a class='btn' href='#'>SEARCH</a>";
          ?>
        </div>
  </div>
  <?php
    echo "<p class='thumbnailHeader'>Featured Recipes</p>";
  ?>
  <div class="thumbnailContainer">
  <?php
    echo "<div>";
  
        //Get all the recipes from "recipes" table in the "idm232" database
        $query = "SELECT * FROM recipes";
        $results = mysqli_query($db_connection, $query);
        if ($results->num_rows > 0) {
          consoleMsg("Query successful! number of rows: $results->num_rows");
          while ($oneRecipe = mysqli_fetch_array($results)) {
            // echo '<h3>' .$oneRecipe['Title']. ' - '  . $oneRecipe['Cal/Serving']  .  '</h3>';
            echo "<img src='./images/" . $oneRecipe['Main IMG'] . "' alt='Dish Image'>";
            echo '<p>' . $oneRecipe['Title'] . '</p>';
            echo '<figcaption>' . $oneRecipe['Subtitle'] . '</figcaption>';
          }

        } else {
          consoleMsg("QUERY ERROR");
        }
  
    echo "</div>";
    ?>
  </div>
  <footer>
  <?php
    echo "<p>Copyright  &copy;2023 Savor + Sizzle</p>";
  ?>
  </footer>

<script src="script.js"></script>
</body>

</html>