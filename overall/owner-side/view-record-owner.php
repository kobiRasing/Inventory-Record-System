<html>
<head>
	<title>Autofrost - Customer Records</title>
    <link rel="stylesheet" type="text/css" href="../css/viewrecord.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "recordBody">
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

	<form method="post">
        <input type="text" name="search" placeholder="What are you looking for?">
        <button type="submit">Search</button>
    </form>

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
            if(!$sqlConnect) 
				die("Failed to connect to the database");

            // choose the database
            $dbName = 'inventory_system';
            $selectDB = mysqli_select_db($sqlConnect,$dbName);
            if(!$selectDB) 
				die("Failed to select the following databaseL: " . $dbName);

			// Query database to get customer records
			$sql = "SELECT * FROM customer_record_table";
			
			if (isset($_POST['search'])) {
                $search = mysqli_real_escape_string($sqlConnect, $_POST['search']);
                $sql = "SELECT RecordID, CustomerName, CarModel, PhoneNumber, PlateNumber FROM customer_record_table WHERE CustomerName LIKE '%$search%' OR CarModel LIKE '%$search%' OR PhoneNumber LIKE '%$search%' OR PlateNumber LIKE '%$search%'";
            }

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
				echo "<table><tr><td>0 Results!.</td></tr></table>";
			}

			mysqli_close($sqlConnect);
		?>
	</table>
</body>
</html>
