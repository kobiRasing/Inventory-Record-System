<html>
<head>
	<title>Autofrost - Customer Records</title>
    <link rel="stylesheet" type="text/css" href="../css/viewrecord.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "recordBody">
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

	<form id="search"method="post">
        <input type="text" name="search" placeholder="What are you looking for?">
        <button type="submit">Search</button>
    </form>

	<table>
		<tr>
			<th style="width: 5%;">Record ID</th>
			<th style="width: 10%;">Customer Name</th>
			<th style="width: 15%;">Car Model</th>
			<th style="width: 10%;">Phone Number</th>
			<th style="width: 10%;">Plate Number</th>
			<th style="width: 10%;">Edit</th>
			<th style="width: 10%;">Delete</th>
            <th style="width: 10%;">Check Jobs</th>
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
					echo "<form method='post' action='edit-record.php'>";
					echo "<td><input type='text' name='RecordID' value='" . $row["RecordID"] . "'></td>";
					echo "<td><input type='text' name='CustomerName' value='" . $row["CustomerName"] . "'></td>";
					echo "<td><input type='text' name='CarModel' value='" . $row["CarModel"] . "'></td>";
					echo "<td><input type='text' name='PhoneNumber' value='" . $row["PhoneNumber"] . "'></td>";
					echo "<td><input type='text' name='PlateNumber' value='" . $row["PlateNumber"] . "'></td>";
					echo "<input type='hidden' name='is_save_clicked' value='false'>";
					echo "<td><button type='submit' name='save_button'>Save</button></td>";
					echo "</form>";
			
					echo "<form method='post' action='delete-record.php'>
					<td><input type='hidden' name='RecordID' value='".$row["RecordID"]."'>
					<button type='submit'>Delete</button></td>
					</form>";
					
					echo "<td><a href='view-jobs-employee.php?RecordID=" . $row["RecordID"] . "&is_save_clicked=false'>View Jobs</a></td>
					</tr>";
				}
			} else {
				echo "<table><tr><td>0 Results!</td></tr></table>";
			}

			mysqli_close($sqlConnect);
		?>
	</table>
</body>
</html>