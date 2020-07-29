<?php
	session_start();
	if((isset($_SESSION["logged_in"]))&&($_SESSION["logged_in"]=='pass'))
	{
				header("LOCATION: game.php");

		}
			else
			 {

 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Game on PHP</title>
	  <link rel="stylesheet" href="st.css">
	</head>
	<body style="font-family: sans-serif;">
		<a href="game.php" style="text-align:'right';">Home-page</a>
		<h1>PLEASE LOGIN</h1>
		<?php
		header("st.css");
		if(isset($_SESSION["error"]))
		{
			echo('<p id="e">'.$_SESSION["error"]."</p>\n");
			unset($_SESSION["error"]);
		}
		if(isset($_SESSION["success"]))
		{
			echo('<p id="g">'.$_SESSION["success"]."</p>\n");
			unset($_SESSION["success"]);
		}
		 ?>
    <form method="post">
      <p>
	      <label for="uid"><b>Input Username:  </b></label>
	      <input type="text" name="uid" id="uid"/><br>
	      <label for="upd"><b>Input Password :   </b></label>
	      <input type="password" name="upd" id="upd"/><br>
	      <label><b>Remember me</b></label>
	      <input type="checkbox" name="remember" id="remember"/>
      </p>
      <input type="submit" value="Click here"/>
    </form>

		<pre>
		<?php
			$pdo=new PDO('mysql:host=localhost;port=3307;dbname=people','anjali','ctc');
			if (isset($_POST['uid']) && isset($_POST['upd']))
			{
				$sql = "SELECT uid FROM credentials WHERE uid = :uid and upd = :upd ";
				$stmt=$pdo->prepare($sql);
				$stmt->execute(array(':uid'=>$_POST['uid'],
															':upd'=>$_POST['upd']));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				if ($row === false)
				{
					$_SESSION["error"]="Incorrect password.";
					header("LOCATION: index.php");
				}
				else
				{
					if (!empty($_POST['remember']))
					{
						setcookie ("uid", $_POST['uid'], time()+ (10 * 365 * 24 * 60 * 60));
						setcookie ("upd",	$_POST['upd'],	time()+ (10 * 365 * 24 * 60 * 60));
					}
					else
					{
						setcookie ("uid","");
						setcookie ("upd","");
					}
					$_SESSION["uid"]=$_POST['uid'];
					$_SESSION["success"]="Login success";
					$_SESSION["logged_in"]="pass";
					header("LOCATION: game.php");
				}
			}

		 ?>

	 </pre>
	</body>
</html>
<?php
	}

?>
