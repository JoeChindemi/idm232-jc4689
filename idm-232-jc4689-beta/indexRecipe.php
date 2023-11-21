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
</head>

<body>
    <?php
        //RANDOM NUM FOR REFRESH
        $myRanVar = rand(1, 37);
        // $myRanVar = 37;
        //DEBUGGING
        //5H, 6H, 13H, 14H 14.6, 15H, 16H 16I 16.6,
        //17H 17.6, 18H, 19H, 20.3 20.6, 21H 21.3 21.6, 22H 22.3 22.5,
        //23.1 23.2 23.3 23.4 23.5 23.6, 24H 24.6, 25H, 26H, 29H, 30H
        //31H, 32H 32.3, 33H, 35H, 37H
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

    <?php
    echo '<header>';
    echo '  <img class="logo" src="./images/smallBannerLogo.png" alt="logo">';
    echo '    <nav class="sample">';
    echo '    </nav>';
    echo '</header>';
    ?>

    <nav class="mobile-nav">
        <?php
        // echo '<a href="#">ALL RECIPES</a>';
        // echo '<a href="#">CHICKEN</a>';
        // echo '<a href="#">PORK</a>';
        // echo '<a href="#">BEEF</a>';
        // echo '<a href="#">FISH</a>';
        // echo '<a href="#">TURKEY</a>';
        // echo '<a href="#">VEGETARIAN</a>';
        // echo '<a href="#">STEAK</a>';
        ?>
    </nav>

    <div class="buttonDiv">
        <?php
        echo '<button class="goBack">BACK</button>';
        ?>
    </div>

    <div class="gridContainer">
        <?php
         $query = "SELECT * FROM recipes WHERE id=$myRanVar";
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

    <div class="det_ing_img_div">
        <?php
         $query = "SELECT * FROM recipes WHERE id=$myRanVar";
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
                // echo '<p>4 Boneless, Skinless Chicken Breasts<br>1 Tbsp Ancho Chile Paste<br>2 Tbsps Crème Fraîche<br>3 Tbsps Golden Raisins<br>1 Lime<br>2 Tbsps Butter<br>2 Cloves Garlic<br>3/4 Jasmine Rice<br>4 Carrots<br>1 Bunch Kale</p>';
                echo '<ul>';
                // INGREDIENTS BUllET LIST
                //   echo '<p> Ingredients: ' . $oneRecipe['All Ingredients']  .  '</p>'; 
                
                  // CONVERT INGREDIENTS STRING INTO ARRAY
                  $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
                //   echo '<p> Ingredients Array: ' . $ingredientsArray[1]  .  '</p>'; 

                  // LOOP THRU INGREDIENTS ARRAY
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

    <div class="stepsHeader">
        <?php
        echo '<h1>STEPS</h1>';
        ?>
    </div>

    <div class="flexContainer">
        <?php
            $query = "SELECT * FROM recipes WHERE id=$myRanVar";
            $results = mysqli_query($db_connection, $query);
            if ($results->num_rows > 0) {
                consoleMsg("Query successful! number of rows: $results->num_rows");
                while ($oneRecipe = mysqli_fetch_array($results)) {
            // echo '<img class="img-step-1" src="./images/0101_FPP_Chicken-Rice_18594_WEB_high_feature.jpg">';
            // echo '<p class="p-step-1">1: Place an oven rack in the center of the oven, then preheat to 450°F. In a medium pot, combine the <strong>rice, a big pinch of salt,</strong> and <strong>1 1/2 cups of water.<strong> Heat to boiling on high. Once boiling, cover and reduce the heat to low. Cook 12 to 14 minutes, or until the water has been absorbed and the rice is tender. Turn off the heat and fluff with a fork. Cover to keep warm.</p>';
        $stepTextArray = explode("*", $oneRecipe['All Steps']);
        //   echo '<p> Number of Step Text: ' . count($stepTextArray) . '</p>';
          
          $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);
        //   echo '<p> Number of Step Images: ' . count($stepImagesArray) . '</p>';   

          for($lp = 0; $lp < count($stepTextArray); $lp++) {
            // If step starts with a number, get number minus one for image name
            $firstChar = substr($stepTextArray[$lp],0,1);
            if (is_numeric($firstChar)) {
              consoleMsg("First Char is: $firstChar");
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

    <?php
    echo '<footer>';
        echo '<p>Copyright  &copy;2023 Savor + Sizzle</p>';
    echo '</footer>';
    ?> 

    <?php
      // Get all the recipes from "recipes" table in the "idm232" database
      $query = "SELECT * FROM recipes WHERE id=$myRanVar";
      $results = mysqli_query($db_connection, $query);
      if ($results->num_rows > 0) {
        consoleMsg("Query successful! number of rows: $results->num_rows");
        while ($oneRecipe = mysqli_fetch_array($results)) {


            
          //TITLE
        //   echo '<h3> Title: ' .$oneRecipe['Title']. '</h3>';

        //   // SUBTITLE
        //   echo '<h3> Subtitle: ' .$oneRecipe['Subtitle']. '</h3>'; 

        //   // HERO IMAGE
        //   echo '<figure class="oneRec">';
        //   echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Dish Image">';
        //   echo '</figure>';

        //   // COOKTIME
          
        //   // SERVINGS
          
        //   // NUTRITION
        //   echo '<h3> Calories Per Serving: ' . $oneRecipe['Cal/Serving']  .  '</h3>'; 
          
        //   // DESCRIPTION
        //   echo '<p> Description: ' . $oneRecipe['Description']  .  '</p>'; 
          
        //   // INGREDIENTS IMAGE
        //   echo '<p><img src="./images/' . $oneRecipe['Ingredients IMG'] . '" alt="Dish Image"></p>';
          
        //   // INGREDIENTS BUllET LIST
        //   echo '<p> Ingredients: ' . $oneRecipe['All Ingredients']  .  '</p>'; 
          
        //   // CONVERT INGREDIENTS STRING INTO ARRAY
        //   $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
        //   echo '<p> Ingredients Array: ' . $ingredientsArray[1]  .  '</p>'; 

        //   // LOOP THRU INGREDIENTS ARRAY
        //   echo '<ul>';
        //   for($lp = 0; $lp < count($ingredientsArray); $lp++) {
        //     echo '<li>' . $ingredientsArray[$lp] . '</li>';
        //   }
        //   echo '<ul>';

        //   // INSTRUCTIONS STEP TEXT
        //   // INSTRUCTIONS STEP IMAGE


        //   $stepTextArray = explode("*", $oneRecipe['All Steps']);
        //   echo '<p> Number of Step Text: ' . count($stepTextArray) . '</p>';
          
        //   $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);
        //   echo '<p> Number of Step Images: ' . count($stepImagesArray) . '</p>';   

        //   for($lp = 0; $lp < count($stepTextArray); $lp++) {
        //     // If step starts with a number, get number minus one for image name
        //     $firstChar = substr($stepTextArray[$lp],0,1);
        //     if (is_numeric($firstChar)) {
        //       consoleMsg("First Char is: $firstChar");
        //       echo '<img src="./images/' . $stepImagesArray[$firstChar-1] . '" alt="Step Image">';
        //     }
        //     echo '<p>' . $stepTextArray[$lp] . '</p>';
        //   }
        }

      } else {
        consoleMsg("QUERY ERROR");
      }
    ?>
    

    <script src="script.js"></script>
</body>

</html>