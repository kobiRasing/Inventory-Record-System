<html>
<head>
    <title>Autofrost - Job Record Table</title>
    <link rel="stylesheet" type="text/css" href="../css/viewjobs.css">
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id = "jobsBody">
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

        if (isset($_GET['RecordID'])) {
            $RecordID = $_GET['RecordID'];
                // Retrieve job records from job_record_table with matching RecordID
                $sql = "SELECT JobDone, DateofJob, JobCost FROM job_record_table WHERE RecordID = '$RecordID' ORDER BY DateOfJob DESC";
                $result = mysqli_query($sqlConnect, $sql);

                // Display table of job records
                if (mysqli_num_rows($result) > 0) {
                    echo "<table><tr><th>Job Done</th><th>Date of Job</th><th>Job Cost</th></tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["JobDone"] . "</td><td>" . $row["DateofJob"] . "</td><td>" . $row["JobCost"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No job records found for this customer.";
                }

                mysqli_close($sqlConnect);
        } else {
            echo "No record ID provided.";
        }
	?>
</body>
</html>
