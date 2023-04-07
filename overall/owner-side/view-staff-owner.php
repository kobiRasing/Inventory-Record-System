<html>
<head>
	<title>Autofrost - Staff Record Table</title>
    <link rel="stylesheet" type="text/css" href="../css/viewstaff.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "staffBody">
	<nav>	
        <ul>
			<li onclick="location.href='main-menu-owner.php';">Home</li>
            <li onclick="location.href='view-record-owner.php';">Customer Records</li>
            <li onclick="location.href='view-staff-owner.php';">Staff Information</li>
            <li onclick="location.href='../login.php';">Logout</li>
            <img src="../css/images/ico.png" alt="Logo" onclick="location.href='main-menu-owner.php';">
        </ul>
    </nav>
	
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
