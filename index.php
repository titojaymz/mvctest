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
else
{
	header('location: userlist.php');
}
?>