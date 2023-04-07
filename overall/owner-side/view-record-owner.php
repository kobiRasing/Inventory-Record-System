<!DOCTYPE html>
<html>
<head>
	<title>Customer Record Table</title>
</head>
<body>
	<h1>Customer Record Table</h1>
	<table>
		<tr>
			<th>Record ID</th>
			
			<th>Customer Name</th>
			<th>Car Model</th>
			<th>Phone Number</th>
			<th>Plate Number</th>
		</tr>
		<?php
            // open connection to mysql
            $sqlConnect = mysqli_connect('localhost','root','');
            if(!$sqlConnect) die("Failed to connect to the database");

            // choose the database
            $dbName = 'inventory_system';
            $selectDB = mysqli_select_db($sqlConnect,$dbName);
            if(!$selectDB) die("Failed to select the following databaseL: " . $dbName);


			// Query database to get customer records
			$sql = "SELECT * FROM customer_record_table";
			$result = mysqli_query($sqlConnect, $sql);

			if (mysqli_num_rows($result) > 0) {
				// Output each customer record
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["RecordID"] . "</td>";
					//echo "<td>" . $row["DateOfJob"] . "</td>";
					echo "<td>" . $row["CustomerName"] . "</td>";
					echo "<td>" . $row["CarModel"] . "</td>";
					echo "<td>" . $row["PhoneNumber"] . "</td>";
					echo "<td>" . $row["PlateNumber"] . "</td>";
                    echo "<td><a href='view-jobs-owner.php?RecordID=" . $row["RecordID"] . "'>View Jobs</a></td>";
					echo "</tr>";
				}
			} else {
				echo "0 results";
			}

			mysqli_close($sqlConnect);
		?>
	</table>
</body>
</html>
