<html>
<head>
	<title>Autofrost - Staff Record Table</title>
    <link rel="stylesheet" type="text/css" href="../css/viewstaff.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "staffBody">
	<nav>	
        <ul>
			<li onclick="location.href='main-menu-employee.php';">Home</li>
            <li onclick="location.href='add-new-record.php';">Add New Record</li>
            <li onclick="location.href='add-existing-record.php';">Add Existing Record</li>
			<li onclick="location.href='view-record-employee.php';">View Records</li>
            <li onclick="location.href='../login.php';">Logout</li>
            <img src="../css/images/ico.png" alt="Logo" onclick="location.href='main-menu-employee.php';">
        </ul>
    </nav>
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
                    echo "<td><a href='view-jobs-employee.php?RecordID=" . $row["RecordID"] . "'>View Jobs</a></td>";
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