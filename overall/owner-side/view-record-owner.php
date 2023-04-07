<!DOCTYPE html>
<html>
<head>
	<title>Autofrost - Customer Record Table</title>
    <link rel="stylesheet" type="text/css" href="../css/viewrecord.css">
</head>
<body id = "recordBody">
    <div class="recordHeader">
        <h1>AUTOFROST</h1>
        <h3>Record Management System</h3>
    </div>
	<table>
		<tr>
			<th>Record ID</th>
			<th>Customer Name</th>
			<th>Car Model</th>
			<th>Phone Number</th>
			<th>Plate Number</th>
            <th>Check Jobs</th>
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
