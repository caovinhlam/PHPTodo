<?php
	session_start(); //starts the session
	if($_SESSION['userid']){ //checks if user is logged in
	}
	else{
        header("location:index.php"); // redirects if user is not logged in
	}

	if($_SERVER['REQUEST_METHOD'] = "POST")
	{
        $db = mysqli_connect("localhost", "root","", "account_db") or die(mysql_error()); //Connect to server and database

        // Make data safe for SQL
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $due_date = mysqli_real_escape_string($db, $_POST['due_date']);
        $user_id = mysqli_real_escape_string($db, $_POST['addId']);

		mysqli_query($db, "INSERT INTO todo (title, description, due_date, user_id) VALUES ('$title','$description','$due_date','$user_id')"); //Query to add user entries
		header("location: home.php"); //redirects back to home
	}
	else
	{
		header("location:home.php"); //redirects back to home
	}
?>