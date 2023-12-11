<!DOCTYPE html>

<html>


<head>
  <title>PHP Recipe Details Dynamic</title>
  <link rel="stylesheet" href="./styles/generalRecipe.css">
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
        //Get ID selector from index
        $recID = $_GET['recID'];
        $query = "SELECT * FROM recipes WHERE id={$recID}";
    ?>
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

    <!--Echo header logo -->
    <?php
      echo '<header>';
      echo "<a class='logo' href='index.php'><img class='logo' src='./images/smallBannerLogo.png' alt='logo'></a>";
      echo '    <nav class="sample">';
      echo '    </nav>';
      echo '</header>';
    ?>

    <!--Echo back button logo -->
    <div class="buttonDiv">
        <span class="goBack" onClick="window.history.back();">
          BACK
        </span>
    </div>

    <!--Echo gridcontainer. This container contains the hero imgage, title, subtitle, and description.  ID is imported based on recID from selected thumbnail image on index page, each element follows the ID number.-->
    <div class="gridContainer">
      <?php
         $query = "SELECT * FROM recipes WHERE id=$recID";
         $results = mysqli_query($db_connection, $query);
         if ($results->num_rows > 0) {
           consoleMsg("Query successful! number of rows: $results->num_rows");
           while ($oneRecipe = mysqli_fetch_array($results)) {
            echo '<div class="item-2">';
                echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Dish Image">';
            echo '</div>';
            echo '<div class="item-1">';
                echo '<h1> ' .$oneRecipe['Title']. '</h1>';
                echo '<p class ="recipeSubhead"> ' .$oneRecipe['Subtitle']. '</p>';
                echo '<br>';
                echo '<p class="recipeCaption"> ' . $oneRecipe['Description']  .  '</p>'; 
            echo '</div>';
        }
        } else {
        consoleMsg("QUERY ERROR");
        }
      ?>
    </div>

    <!--Echo det_ing_img_div container. This container contains the ingredients image, details list, and ingredients list.  ID is imported based on recID from selected thumbnail image on index page, each element follows the ID number.-->
    <div class="det_ing_img_div">
      <?php
        $query = "SELECT * FROM recipes WHERE id=$recID";
        $results = mysqli_query($db_connection, $query);
        if ($results->num_rows > 0) {
          consoleMsg("Query successful! number of rows: $results->num_rows");
          while ($oneRecipe = mysqli_fetch_array($results)) {
          echo '<div class="ing_img">';
            echo '<p><img src="./images/' . $oneRecipe['Ingredients IMG'] . '" alt="Dish Image"></p>';
          echo '</div>';
          echo '<div class="det_ing">';
            echo '<h1>DETAILS</h1>';
            echo '<p> Cook Time: ' . $oneRecipe['Cook Time']  .  '</p>';
            echo '<p>Servings: ' . $oneRecipe['Servings']  .  '</p>';
            echo '<p> Calories Per Serving: ' . $oneRecipe['Cal/Serving']  .  '</p>'; 
            echo '<p>Proteins: ' . $oneRecipe['Proteine']  .  '</p>';
            echo '<br>';
            echo '<h1>INGREDIENTS</h1>';
              echo '<ul>';
              $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
                echo '<ul>';
                for($lp = 0; $lp < count($ingredientsArray); $lp++) {
                  echo '<li>' . $ingredientsArray[$lp] . '</li>';
                }
                echo '<ul>';
            echo '</div>';
        }
        } else {
        consoleMsg("QUERY ERROR");
        }
      ?>
    </div>

    <!-- Echo steps header -->
    <div class="stepsHeader">
        <?php
        echo '<h1>STEPS</h1>';
        ?>
    </div>

    <!--Echo flexcontainer. This container contains the stpes and their correlating images.  ID is imported based on recID from selected thumbnail image on index page, each element follows the ID number. A loop goes throught the mySQL database and determines steps through reading the numbers in front of each step.  Each image and step is split using the "*" character.-->
    <div class="flexContainer">
        <?php
            $query = "SELECT * FROM recipes WHERE id=$recID";
            $results = mysqli_query($db_connection, $query);
            if ($results->num_rows > 0) {
                consoleMsg("Query successful! number of rows: $results->num_rows");
                while ($oneRecipe = mysqli_fetch_array($results)) {
        $stepTextArray = explode("*", $oneRecipe['All Steps']);
          $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);   
          for($lp = 0; $lp < count($stepTextArray); $lp++) {
            // If step starts with a number, get number minus one for image name
            $firstChar = substr($stepTextArray[$lp],0,1);
            if (is_numeric($firstChar)) {
              echo "<hr>";
              consoleMsg("First Char is: $firstChar");
              echo '<br></br><br></br>';
              echo '<img src="./images/' . $stepImagesArray[$firstChar-1] . '" alt="Step Image">';
            }
            echo '<p>' . $stepTextArray[$lp] . '</p>';
          }
         }
        } else {
        consoleMsg("QUERY ERROR");
        }
        ?>
    </div>
    
    <!-- Echo footer -->
    <?php
    echo '<footer>';
        echo '<p>Copyright  &copy;2023 Savor + Sizzle</p>';
    echo '</footer>';
    ?>     
</body>

</html>
