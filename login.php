<?php 
session_start();
include_once "cfg.php";
include_once "model/DAO.php";
include_once "model/User_model.php";
include_once "controller/user.php";

$user = new user();

if($user->sessionCheck())
{
	header('location: userlist.php');
}

$username = $_REQUEST['username'];
if($username == '')
{
	$username = NULL;
}
else
{
	$username = $_REQUEST['username'];
}

$password = $_REQUEST['password'];
if($password == '')
{
	$password = NULL;
}
else
{
	$password = $_REQUEST['password'];
}

if($username <> NULL && $password <> NULL)
{
	echo $user->loginUser($username,$password);
}
?>
<html>
<head>
</head>
<body>
<form method="post">
<input type="text" name="username" required><br>
<input type="password" name="password" required><br>
<button type="submit">Login</button>
</form>
<br><br>
<a href="register.php">Register</a>
</body>
<html>