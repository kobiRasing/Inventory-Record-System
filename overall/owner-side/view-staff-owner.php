<!DOCTYPE html>
<html>
<head>
	<title>Autofrost - Staff Record Table</title>
    <link rel="stylesheet" type="text/css" href="../css/viewstaff.css">
</head>
<body id = "staffBody">
    <div class="staffHeader">
        <h1>AUTOFROST</h1>
        <h3>Record Management System</h3>
    </div>
	<table>
		<tr>
			<th>Name</th>
			<th>Phone Number</th>
			<th>Address</th>
            <th>Age</th>
            <th>Birthday</th>
		</tr>
		<?php
            // open connection to mysql
            $sqlConnect = mysqli_connect('localhost','root','');
            if(!$sqlConnect) 
                die("Failed to connect to the database");

            // choose the database
            $dbName = 'inventory_system';
            $selectDB = mysqli_select_db($sqlConnect,$dbName);
            if(!$selectDB) 
                die("Failed to select the following databaseL: " . $dbName);

			// Query database to get customer records
			$sql = "SELECT StaffName, StaffPhoneNumber, StaffAddress, StaffAge, StaffBirthday FROM staff_info_table";
			$result = mysqli_query($sqlConnect, $sql);

			if (mysqli_num_rows($result) > 0) {
				// Output each customer record
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row["StaffName"] . "</td>";
					echo "<td>" . $row["StaffPhoneNumber"] . "</td>";
					echo "<td>" . $row["StaffAddress"] . "</td>";
					echo "<td>" . $row["StaffAge"] . "</td>";
					echo "<td>" . $row["StaffBirthday"] . "</td>";
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
