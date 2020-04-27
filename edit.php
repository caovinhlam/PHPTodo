<?php
	session_start(); //starts the session
	if($_SESSION['userid']) { //checks if user is logged in
	}
	else{
		header("location:index.php"); // redirects if user is not logged in
    }
    if($_SERVER['REQUEST_METHOD'] = "POST") //Added an if to keep the page secured
	{
        $db = mysqli_connect("localhost", "root","", "account_db") or die(mysql_error()); //Connect to server and database
        
        // Make data safe for SQL
        $id = mysqli_real_escape_string($db, $_POST['editId']);
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $due_date = mysqli_real_escape_string($db, $_POST['due_date']);

        mysqli_query($db, "UPDATE todo SET title='$title', description='$description', due_date='$due_date' WHERE id='$id'"); //Query to edit user entries

        header("location: home.php"); //redirects back to home
    }
    else
	{
		header("location:home.php"); //redirects back to home
	}
?>