<?php
session_start();
include_once "controller/user.php";
$user = new user();
$user->sessionDestroy();
header('location: login.php');
?>