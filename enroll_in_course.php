<?php 
session_Start();

if(ISSET($_POST["submitBtn"])) {
	$courseID=$POST_['courseID'];
	
	if (!isset($_SESSION['schedule'])) {
	$_SESSION['cart'] = [];
	}
	
	if (!in_array($courseID, $_SESSION['schedule'])) {
	$_SESSION['cart']] = $courseID;
	}
?>