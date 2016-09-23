<?php
session_start();

session_destroy();
// Double check to see if their sessions exists
if(isset($_SESSION['username'])){


} else {
	header("location:login.php");
	exit();
} 
?>