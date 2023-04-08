<html>
<head>
	<title>Autofrost - Manage Staff</title>
    <link rel="stylesheet" type="text/css" href="../css/viewstaff.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "staffBody">
	<nav>	
        <ul>
			<li onclick="location.href='main-menu-owner.php';">Home</li>
            <li onclick="location.href='add-new-record.php';">Add New Record</li>
            <li onclick="location.href='add-existing-record.php';">Add Existing Record</li>
            <li onclick="location.href='view-record-owner.php';">Customer Records</li>
            <li onclick="location.href='add-staff.php';">Add Staff</li>
            <li onclick="location.href='view-staff-owner.php';">Manage Staff</li>
            <li onclick="location.href='../login.php';">Logout</li>
            <img src="../css/images/ico.png" alt="Logo"onclick="location.href='main-menu-owner.php';">
        </ul>
    </nav>
	
	<table>
		<tr>
			<th style="width: 10%;">Name</th>
			<th style="width: 10%;">Phone Number</th>
			<th style="width: 40%;">Address</th>
            <th style="width: 3%;">Age</th>
            <th style="width: 10%;">Birthday</th>
			<th>Edit</th>
			<th>Delete</th>
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
			$sql = "SELECT * FROM staff_info_table";
			$result = mysqli_query($sqlConnect, $sql);

			if (mysqli_num_rows($result) > 0) {
				// Output each customer record
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<form method='post' action='edit-staff.php'>";
					echo "<td><input type='text' name='StaffName' value='" . $row["StaffName"] . "'></td>";
					echo "<td><input type='text' name='StaffPhoneNumber' value='" . $row["StaffPhoneNumber"] . "'></td>";
					echo "<td><input type='text' name='StaffAddress' value='" . $row["StaffAddress"] . "'></td>";
					echo "<td><input type='text' name='StaffAge' value='" . $row["StaffAge"] . "'></td>";
					echo "<td><input type='text' name='StaffBirthday' value='" . $row["StaffBirthday"] . "'></td>";
					echo "<input type='hidden' name='StaffID' value='".$row["StaffID"]."'>";
					echo "<td><button type='submit'>Save</button></td>";
					echo "</form>";

					echo "<form method='post' action='delete-staff.php'>
                    <td><input type='hidden' name='StaffID' value='".$row["StaffID"]."'>
                    <button type='submit'>Delete</button></td>
					</form>
					</tr>";
				}
			} else {
				echo "<table><tr><td>0 Results!.</td></tr></table>";
			}

			mysqli_close($sqlConnect);
		?>
	</table>
</body>
</html>
