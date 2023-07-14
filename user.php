<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
	<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
		color: #fff;
		background-color: #10002b;
	}


 



    h1 {
        text-align: center;
    }
	.content{
		width: 60%;
		margin-bottom: 30px;
		height: 50%;
		background-color: #eee;
		box-shadow: 0px 2px 10px #1b263b;
		margin-left: 280px;
		padding: 20px;
		border-radius: 10px;
		}

    table {
		border: 1px ;
        margin: 0 auto;
        border-collapse: collapse;
		border-radius: 5px;
    color: #000;
	}

    th,
    td {
        border: 1px;
        padding: 10px;
        border-radius: 5px; /* Added border-radius for rounded borders */
    }

    th {
        background-color: #1e2749;
		color: #fff;
    }

    tr:nth-child(even) {
        background-color: #e4d9ff;

    }

    tr:hover {
        background-color: #ddd;
    }

    input[type="text"],
    input[type="submit"] {
        padding: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

	.edit-btn {
  background-color: #4d194d;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
}

.edit-btn:hover {
  background-color: #4d194d;
}

.delete-btn {
  background-color: #ef233c;
  color:#fff;
  padding: 5px 10px;
  border-radius: 5px;
}

.delete-btn:hover {
  background-color: #ffd500;
}


</style>



</head>
<body>
	<?php include("./sidebar.php")?>
	<h1>User Management</h1>
	<div class = "content">
	<table>
		<tr>
			<th>User ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
		// Connect to database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "IoT_Framework";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Retrieve data from user table
		$sql = "SELECT * FROM Users";
		$result = mysqli_query($conn, $sql);

		// Display data in table
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$row['user_id']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td><a href='edit.php?id=".$row['user_id']."'><button class='edit-btn'>Edit</button></a></td>";
echo "<td><a href='delete.php?id=".$row['user_id']."'><button class='delete-btn'>Delete</button></a></td>";


			echo "</tr>";
		}

		// Close database connection
		mysqli_close($conn);
		?>
		<tr>
			<form action="add.php" method="POST">
				<td></td>
				<td><input type="text" name="name"></td>
				<td><input type="text" name="email"></td>
				<td><input type="text" name="password"></td>
				<td></td>
				<td><input type="submit" class="delete-btn"value="Add"></td>
			</form>
		</tr>
	</table>
	</div>
</body>
</html>
