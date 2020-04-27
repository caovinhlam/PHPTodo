<?php
	session_start(); //starts the session
	if($_SESSION['userid']){ //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
	}

	if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		$db = mysqli_connect("localhost", "root","", "account_db") or die(mysql_error()); //Connect to server and database
		$id = $_GET['id'];
		mysqli_query($db, "DELETE FROM todo WHERE id='$id'"); //Query to delete user entries
		header("location: home.php"); //redirects back to home
	}
?>