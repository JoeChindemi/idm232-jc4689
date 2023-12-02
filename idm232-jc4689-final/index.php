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
  <link rel="icon" type="image/x-icon" href="./images/smallBannerLogo.png">
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

  <!-- Echo commands for header and filters -->
  <header>
    <?php
      echo "<img class='logo' src='./images/smallBannerLogo.png' alt='logo'>";
      echo "<nav class='sample'>";
      echo "<ul class='nav_links'>";
        echo "<li>"; echo "<a href='index.php?filter=chicken'>CHICKEN</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=pork'>PORK</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=beef'>BEEF</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=fish'>FISH</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=turkey'>TURKEY</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=vegitarian'>VEGETARIAN</a>"; echo "</li>";
        echo "<li>"; echo "<a href='index.php?filter=steak'>STEAK</a>"; echo "</li>";
      echo "</nav>";
      echo "<button class='hamburger'>";
        echo "<div class='bar'></div>";
      echo "</button>";
    ?>
  </header>

  <!-- Mobile hamburger menu links w/ anchors -->
  <nav class="mobile-nav">
    <?php
      echo "<a href='index.php?filter=chicken'>CHICKEN</a>";
      echo "<a href='index.php?filter=pork'>PORK</a>";
      echo "<a href='index.php?filter=beef'>BEEF</a>";
      echo "<a href='index.php?filter=fish'>FISH</a>";
      echo "<a href='index.php?filter=turkey'>TURKEY</a>";
      echo "<a href='index.php?filter=vegitarian'>VEGETARIAN</a>";
      echo "<a href='index.php?filter=steak'>STEAK</a>";
    ?>
  </nav>

  <!-- Container for hero image and search -->
  <div class="img-container">
      <!-- Hero image div -->
      <div class="inner-container">
        <?php
          echo "<img class='heroImg' src='./images/longBannerLogo.png' alt='header logo'>";
          echo "<p class='heroSubtitle'>Where Flavor Takes Center Stage &dash; Savor the Culinary Journey!</p>";
        ?>

        <!-- Button/Form div w/ search php code -->
        <form action ="index.php" method="POST">
          <input class="input" id ="search" name = "search" placeholder="What&apos;s cooking?" value="<?php echoSearchValue(); ?>">
          <button class="btn" name="submit" id="submit">SEARCH</button>
        </form>
      </div>
  </div>

  <!-- Thumbnail image header -->
  <?php
    echo "<p class='thumbnailHeader'>Featured Recipes</p>";
  ?>

  <!-- Thumbnail container -- Uses search paramerters and selected filters to dispaly thumbnail images -->
  <div class="thumbnailContainer">
        <?php
            //Get search
            $search = $_POST['search'];
            consoleMsg("Search string is $search");

            // Get filter info if passed in URL
            $filter = $_GET['filter'];
            consoleMsg("Filter is: $filter");

            //If search is not empty
            if (!empty($search)) {
              consoleMsg("Doing a SEARCH");
              // $query = "select * FROM recipes WHERE title LIKE '%{$search}%'";
              $query = "select * FROM recipes WHERE Title LIKE '%{$search}%' OR Subtitle LIKE '%{$search}%'";
            } 
            elseif (!empty($filter)) {
              consoleMsg("Doing a FILTER");
              $query = "select * FROM recipes WHERE proteine LIKE '%{$filter}%'";
            } 
            else {
              consoleMsg("Loading ALL RECIPES");
              $query = "SELECT * FROM recipes";
            }
  
            //Get all the recipes from "recipes" table in the "idm232" database
            // $query = "SELECT * FROM recipes";
            $results = mysqli_query($db_connection, $query);
            if ($results->num_rows > 0) {
              consoleMsg("Query successful! number of rows: $results->num_rows");
              while ($oneRecipe = mysqli_fetch_array($results)) {  
                  echo '<div>';
                    echo '<a href="./indexRecipe.php?recID='. $oneRecipe['id'] .'">';
                      echo "<img src='./images/" . $oneRecipe['Main IMG'] . "' alt='Dish Image'>";
                      echo '<p>' . $oneRecipe['Title'] . '</p>';
                      echo '<figcaption>' . $oneRecipe['Subtitle'] . '</figcaption>';
                    echo '</a>';
                  echo '</div>';
              }

            } else {
              consoleMsg("QUERY ERROR");
              // Displays message for when search parameter is not found
              echo '<div>';
                echo "<img class='errorImg' src='./images/errorImg.png' alt='header logo'>";
                echo '<p class= "errorMsg">Sorry, we couldn&apos;t find what you were looking for.  Please try searching again!</p>';
              echo '</div>';
            }
        ?>
  </div>

  <!-- Footer echo -->
  <footer>
    <?php
      echo "<p>Copyright  &copy;2023 Savor + Sizzle</p>";
    ?>
  </footer>

<!-- Implement script for search button microinteraction and hamburger menu animation-->
<script src="./scripts/script.js"></script>
</body>

</html>