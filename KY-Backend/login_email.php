<?php 
$pdo = new PDO('mysql:host=localhost;port=8888;dbname=backend','root','root');
$err = $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<?php
function check_email($email)
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

//We also need to check for whether the input data 
//is already there on the database, I didn't have 
//much time so I wasn't able to add that, but we can do it 

if ($_POST['register']) {
	$name = $_POST['name'];
	$email = $_POST['newemail'];
	$password = md5($_POST['newpass']);
	if (check_email($email)) {
		$inp = "INSERT INTO user_info (name, email, password) VALUES ($name, $email, $password)";
		$pdo->exec($inp);
		echo "User Registered";
	}
	else {
		echo "Data Input Incorrect";
	}
}

function vaild($email,$password) {
	$stmt = $pdo->query("SELECT FROM user_info WHERE email=$email");
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($data['password'] == $password) {
		return true;
	}
	else {
		return false;
	}
}

if ($_POST['login']) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	if (vaild('$email','$password')) {
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		header("Location: loggedin.php");
	}
	else {
		echo "Incorrect Password!";
	}
		
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="login.js"></script>
</head>
<body>
	<script type="text/javascript" src="login.js"></script>
	<div class="head">
		<center>
			<h1>KashiYatra'19</h1>
		</center>
	</div>
	<center class="but">
		<button class="button button--secondary" style="font-family: Unithin;" onclick="show('login','register')"><span class="button__inner">Login</span></button>
		<button class="button button--secondary" style="font-family: Unithin;" onclick="show('register','login')"><span class="button__inner">Register</span></button>
	</center>
	<pre>    </pre>
	<div class="box" id="login">
		<h3>Login</h3>
		<hr width="70%">
		<form method="post" action="login_email.php">
			<pre>    </pre>
			E-Mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email"><br>
			Password:&nbsp;&nbsp;<input type="password" name="password"><br>
			<pre>    </pre>
			<center><input style="margin-left: -50px;" class="sub" type="submit" value="Login" name="login"></center>
		</form>
	</div>
	<div class="box" id="register">
		<h3>Register</h3>
		<hr width="70%">
		<form method="post" action="login_email.php">
			<pre>    </pre>
			Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name"><br>
			E-Mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="newemail"><br>
			Password:&nbsp;&nbsp;<input type="password" name="newpass"><br>
			<pre>    </pre>
			<center><input style="margin-left: -50px;" class="sub" type="submit" name="register" value="Register"></center>
		</form>
	</div>
</body>
</html>