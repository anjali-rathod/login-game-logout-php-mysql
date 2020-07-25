<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>GUESSING GAME BY ANJALI RATHOD</title>
    <link rel="stylesheet" href="st.css">
  </head>
  <body>
    <?php
    $h=$_SESSION["logged_in"];
        if($h=='pass')
        {
      ?>
      <h1>Welcome to my guessing game</h1>
      <h3>You have to guess a number between 1-100, if you guess the correct number as of computer ,<br>YOU WIN!</h3>
      <form method="post">
       <label for="guess"><b>Enter a number to guess!!!</b></label>
       <input type="text" name="guess" id="guess"/><br>
      </form>
      <p>
       <?php
       if (!isset($_POST['guess']))
       {
         echo("<p style='color:red;'>Missing Guess Parameter</p>");
       }
       elseif (strlen($_POST['guess'])==1)
        {
         echo("<p style='color:red;'>Your GUess is too low</p>");
       }
       elseif (! is_numeric($_POST['guess']))
        {
         echo("<p style='color:red;'>Your GUess is not a number</p>");
       }
       elseif ($_POST['guess']<42)
       {
         echo("<p style='color:red;'>Your GUess is low</p>");
       }
       elseif ($_POST['guess']>42) {
         echo("<p style='color:red;'>Your GUess is high</p>");
       }
       else {
         echo ("<p style='color:green;'>Congratulations!! Your Guess is corect...</p>");
       }
        ?>
      </p>
      <pre>
        <?php
          $guess=isset($_POST['guess'])?$_POST['guess']:"";
         ?>
      </pre>
      <label><b>Old guess=</b></label>
      <input type="text" value="<?= $guess ?>" disabled/>
      <h3>Please <a href="logout.php">LOG OUT</a> when you are done guessing..</h3>

      <?php
       }
      else {
        header("LOCATION: index.php ");
      }
  ?>
  </body>
</html>
