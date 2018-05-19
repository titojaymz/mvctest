<?php
session_start();
include_once "cfg.php";
include_once "model/DAO.php";
include_once "model/User_model.php";
include_once "controller/user.php";
$user = new user();
if(!$user->sessionCheck())
{
	header('location: login.php');
}
print_r($_SESSION);
?>
<a href="logout.php">Logout</a><br>
<table border="1px">
<thead>
<tr>
<th></th>
<th>User ID</th>
<th>Fullname</th>
<th>Username</th>
<th>Email</th>
<th>OBSU</th>
</tr>
</thead>
<tbody>
<?php echo $user->listUser() ?>
</tbody>
</table>