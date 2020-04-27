<?php
    session_start();
    $db = mysqli_connect("localhost", "root","", "account_db") or die(mysqli_error()); //Connect to server and database
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$query = mysqli_query($db, "SELECT * from users WHERE username='$username'"); //Query the users table if there are matching rows equal to $username
	$exists = mysqli_num_rows($query); //Checks if username exists
	
	$db_users = "";
	$db_password = "";

	if($exists > 0) //IF there are no returning rows or no existing username
	{
		while($row = mysqli_fetch_assoc($query)) //display all rows from query
		{
			$db_users = $row['username']; // the first username row is passed on to $db_users, and so on until the query is finished
			$db_password = $row['password']; // the first password row is passed on to $db_users, and so on until the query is finished
			$_SESSION['userid'] = $row['id'];
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
		}
		if(($username == $db_users) && ($password == $db_password)) // checks if there are any matching fields
		{
				if($password == $db_password)
				{
					header("location: home.php"); // redirects the user to the authenticated home page
				}
		}
		else
		{
            Print '<script>alert("Incorrect Password!");</script>'; //Prompts the user
			Print '<script>window.location.assign("index.php");</script>'; // redirects to index.php
		}
	}
	else
	{
		Print '<script>alert("Incorrect Username!");</script>'; //Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to index.php
	}
?>