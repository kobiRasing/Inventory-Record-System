<!DOCTYPE html>
<html>
<head>
	<title>Customer Record Table</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Customer Record Table</h1>
		<table>
			<thead>
				<tr>
					<th>RecordID</th>
					<th>DateOfJob</th>
					<th>CustomerName</th>
					<th>CarModel</th>
					<th>PhoneNumber</th>
					<th>PlateNumber</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$servername = "localhost";
			$username = "username";
			$password = "password";
			$dbname = "database_name";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM customer_record_table";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>".$row["RecordID"]."</td><td>".$row["DateOfJob"]."</td><td>".$row["CustomerName"]."</td><td>".$row["CarModel"]."</td><td>".$row["PhoneNumber"]."</td><td>".$row["PlateNumber"]."</td></tr>";
			    }
			} else {
			    echo "0 results";
			}

			$conn->close();
			?>
			</tbody>
		</table>
	</div>
</body>
</html>
