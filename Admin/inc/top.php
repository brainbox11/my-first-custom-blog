<?php session_start(); ?>
<?php require_once 'db.php'; ?>
<?php require_once 'function.php'; ?>
<?php 
	if (!isset($_SESSION['uid'])) {
		header("Location: login.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin dashbord</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Oswald:400,300">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animated.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="Scripts/jQuery-3.2.1.js"></script>
	<script src="Scripts/bootstrap.js"></script>
</head>