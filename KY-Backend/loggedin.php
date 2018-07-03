<?php

session_start();

echo "You've Successfully Logged In!!";

if (isset($_POST['logout'])) {
	$_SESSION['loggedin'] = false;
	echo "Logging Out...";
	session_unset();
	header("Location: login_email.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logged In Page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body style="font-family: Gilbert;">
	<div>
		<h1>Email:</h1>
		<?php
		echo $_SESSION['email'];
		?>
		<hr>
	</div>
	<div>
		<form method="post" action="loggedin.php">
			<input style="font-family: Unithin;" type="submit" name="logout" value="Log Out">
		</form>
	</div>
</body>
</html>

