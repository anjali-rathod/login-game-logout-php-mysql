<?php
	session_start();
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
		if(isset($_SESSION["error"]))
		{
			echo('<p style="color: red">'.$_SESSION["error"]."</p>\n");
			unset($_SESSION["error"]);
		}
		if(isset($_SESSION["success"]))
		{
			echo('<p style="color: green">'.$_SESSION["success"]."</p>\n");
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
      <input type="submit"/>
    </form>

		<pre>
		<?php
			$pdo=new PDO('mysql:host=localhost;port=3307;dbname=people',anjali,ctc);
			if (isset($_POST['uid']) && isset($_POST['upd']))
			{
				$sql = "SELECT uid FROM credentials WHERE uid = :uid and upd = :upd ";
				$stmt=$pdo->prepare($sql);
				$stmt->execute(array(':uid'=>$_POST['uid'],
															':upd'=>$_POST['upd']));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);

				unset($_SESSION['uid']);
				if ($row === false)
				{
					$_SESSION["error"]="Incorrect password.";
					header("LOCATION: index.php");
					return;
				}
				else
				{
					if ($_POST['remember'])
					{
						ini_set('session.cookie_lifetime','864000');
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
