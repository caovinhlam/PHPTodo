<?php 
	$username = ""; 
	$fname = "";
	$lname = "";
	$feedback = "";

	$db = mysqli_connect("localhost", "root","", "account_db") or die(mysqli_error()); //Connect to server and database
	if($db) {
		echo 'Success... ' . mysqli_get_host_info($db) . "\n";
	}
	if ($result = mysqli_query($db, "SELECT DATABASE()")) {
		$row = mysqli_fetch_row($result);
		echo "Default database is $row[0]\n";
		mysqli_free_result($result);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = mysqli_connect("localhost", "root","", "account_db") or die(mysqli_error()); //Connect to server and database
		
		// Make data safe for SQL
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$fname = mysqli_real_escape_string($db, $_POST['first_name']);
		$lname = mysqli_real_escape_string($db, $_POST['last_name']);

		$bool = true;
		$query = mysqli_query($db, "SELECT * FROM users"); //Query the users table
		while($row = mysqli_fetch_array($query)) //display all rows from query
		{
			$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
			if($username == $table_users) // checks if there are any matching fields
			{
				$bool = false; // username is taken
				$feedback = "Username has been taken!"; //Prompts the user
			}
		}

		if($bool) // account sucessfully created
		{
			mysqli_query($db, "INSERT INTO users (username, password, first_name, last_name) VALUES ('$username','$password', '$fname', '$lname')"); //Inserts the value to table users
			Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
			Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
		}
	}
?>

<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="todo.css">
	</head>
	<body>
		<h2>Registration Page</h2>
		<br/>
		<div class="centre">
			<a href="index.php">Back to login</a><br/><br/>
			<form action="register.php" method="post">
				
				<input type="text" name="username" placeholder="Username" required="required" value="<?php echo $username;?>" class="form-control" style="width:500px"/>
				<div style="color:red" style="width:500px"> <?= $feedback;?> </div>
				<br/>
				<input type="password" name="password" placeholder="Password" required="required" class="form-control" style="width:500px"/>
				<br/>
				<input type="text" name="first_name" placeholder="First Name" required="required" value="<?php echo $fname;?>" class="form-control" style="width:500px"/>
				<br/>
				<input type="text" name="last_name" placeholder="Last Name" required="required" value="<?php echo $lname;?>" class="form-control" style="width:500px"/>
				<br/>
				<input type="submit" value="Register" class="btn btn-primary"/>
			</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>