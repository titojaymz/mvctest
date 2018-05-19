<?php
include_once "cfg.php";
include_once "model/DAO.php" ;
include_once "model/User_model.php" ;
include_once "controller/user.php";

$user = new user();
if($_REQUEST['x_full_name'] <> '' && $_REQUEST['x_username'] <> '' && $_REQUEST['x_email'] <> '' && $_REQUEST['x_passwd'] <> '' && $_REQUEST['x_directorate_code'] <> '' && $_REQUEST['x_obsu_code'] <> '')
{
	echo $user->registerUser();
}
?>
<a href="login.php">Back to login</a>
<form method="post">
<input type="text" name="x_full_name" placeholder="Fullname"><br>
<input type="text" name="x_username" placeholder="Username"><br>
<input type="email" name="x_email" placeholder="Email"><br>
<input type="password" name="x_passwd" placeholder="**************"><br>
<input type="text" name="x_directorate_code" placeholder="Directorate"><br>
<input type="text" name="x_obsu_code" placeholder="OBSU"><br>
<button type="submit">Register</button>
</form>