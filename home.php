<html>
	<head>
		<title>My first PHP website</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="todo.css">
	</head>
	<?php
        session_start(); //starts the session
        if($_SESSION['userid']){ //checks if user is logged in
            $userid = $_SESSION['userid']; //userid used to display correct todo entries
            echo $userid;
            $first_name = $_SESSION['first_name'];
            $last_name =  $_SESSION['last_name'];
        }
        else{
            header("location:index.php"); // redirects if user is not logged in
        }
	?>
	<body>
        <h2>Home Page</h2>
        <div class="centre">
		<p>Welcome <?php Print "$first_name " . "$last_name"?>!</p> <!--Displays user's name-->
		<a href="logout.php">Click here to logout</a><br/><br/>
        </div>
        <!-- Add Modal -->
        <div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add ToDo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            Title: <input type="text" name="title" placeholder="Title" required="required" class="form-control"/><br/>
                            Description: <textarea type="text" name="description" placeholder="Description" required="required" class="form-control" rows="5"></textarea><br/>
                            Due Date: <input type="date" class="datePicker form-control" name="due_date" required="required"/>
                            <!-- User id attached to the row - Prints the correct todo list from DB -->
                            <input type="hidden" id="addId" name="addId" value="<?php echo $userid;?>"/>
                    </div>
                    <div class="modal-footer">
                        <button id="addClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add"/>
                    </div>
                        </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit ToDo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            Title: <input id="editTitle" type="text"  name="title" placeholder="Title" required="required" class="form-control"/><br/>
                            Description: <input id="editDesc" type="text" name="description" placeholder="Description" required="required" class="form-control"/><br/>
                            Due Date: <input id="editDate" type="date" class="datePicker form-control" name="due_date" required="required"/>
                            <!-- RowId attached - Correctly identify which row to edit -->
                            <input type="hidden" id="editId" name="editId" value=""/>
                    </div>
                    <div class="modal-footer">
                        <button id="editClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                        </form>
                </div>
            </div>
        </div>

		<h3 align="center">My list</h2>

		<table border="2px" width="90%" style="margin: 20px 50px 20px 50px">
            <tbody>
                <tr>
                    <th style="width: 5%; text-align: center;">ID</th>
                    <th style="width: 20%; text-align: center;">Title</th>
                    <th style="width: auto; text-align: center;">Details</th>
                    <th style="width: 8%; text-align: center;">Due Date</th>
                    <th style="width: 5%; text-align: center;">Edit</th>
                    <th style="width: 5%; text-align: center;">Delete</th>
                </tr>
                <?php
                    $db = mysqli_connect("localhost", "root","", "account_db") or die(mysql_error()); //Connect to server
                    $query = mysqli_query($db, "SELECT * FROM todo WHERE user_id='$userid'"); // SQL Query
                    $i = 1;
                    while($row = mysqli_fetch_array($query))
                    {
                        Print "<tr>";
                            Print '<td align="center">'. $i . "</td>";
                            Print '<td '. 'id='.$row['id'].'title>'. $row['title'] . "</td>";
                            Print '<td '. 'id='.$row['id'].'desc>'. $row['description'] . "</td>";
                            Print '<td align="center" '. 'id='.$row['id'].'date>'. $row['due_date'] . "</td>";
                            Print '<td align="center"><a href="#" class="btn btn-primary" onclick="editEntry('.$row['id'].')" data-toggle="modal" data-target="#editModalCenter">Edit</a> </td>';
                            Print '<td align="center" class="deleteCell"><a href="#" class="delete" onclick="deleteEntry('.$row['id'].')">X</a> </td>';
                        Print "</tr>";
                        $i++;
                    }
                ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModalCenter" style="margin:0px 50px 50px 50px; display:block; margin-right: auto; margin-left: auto;">
            Add Entry
        </button>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="todo.js"></script>
        <!-- Timeout Plugin: https://github.com/travishorn/session-timeout -->
        <script src="session-timeout-master/dist/session-timeout.js"></script>
        <script>
            sessionTimeout({
                warnAfter: 600000,
                keepAliveUrl: '/todoweb/home.php',
                stayConnectedBtnText: 'Close',
                timeOutAfter: 1200000,
                timeOutUrl: '/todoweb/logout.php'
            });
        </script>
	</body>
</html>