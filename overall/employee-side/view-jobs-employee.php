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
    <form action = 'view-jobs-employee.php?RecordID=' method = 'post'>
		Search Record: <input type = 'text' name = 'inSearch'/>
		  <input type = 'submit' name = 'search' value = 'Search' />
	</form>
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
                $sql = "SELECT JobID, JobDone, DateofJob, JobCost FROM job_record_table WHERE RecordID = '$RecordID' ORDER BY DateOfJob DESC";
                $result = mysqli_query($sqlConnect, $sql);

                if(isset($_POST['search'])){
                    $inSearch = $_POST['inSearch'];
                    echo $inSearch;
                    if($inSearch == ''){
                        // Display table of job records with delete buttons
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table><tr><th>Job Done</th><th>Date of Job</th><th>Job Cost</th><th>Delete</th></tr>";
                            while($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row["JobDone"] . "</td>";
                                echo "<td>" . $row["DateofJob"] . "</td>";
                                echo "<td>" . $row["JobCost"] . "</td><td>
                                <form method='post' action='delete-job-record.php'>
                                <input type='hidden' name='JobID' value='".$row["JobID"]."'>
                                <button type='submit'>Delete</button>
                                </form></td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<table><tr><td>No job records found for this customer.</td></tr></table>";
                        }
                    }
                    else{
                        // Display table of job records with delete buttons
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table><tr><th>Job Done</th><th>Date of Job</th><th>Job Cost</th><th>Delete</th></tr>";
                            while($row = mysqli_fetch_assoc($result)) {
                                if(str_contains(strtolower($row["JobDone"]),strtolower($inSearch)) || 
								str_contains(strtolower($row["DateofJob"]),strtolower($inSearch)) || 
								str_contains(strtolower($row["JobCost"]),strtolower($inSearch))){
                                    echo "<tr>";
                                    echo "<td>" . $row["JobDone"] . "</td>";
                                    echo "<td>" . $row["DateofJob"] . "</td>";
                                    echo "<td>" . $row["JobCost"] . "</td><td>
                                    <form method='post' action='delete-job-record.php'>
                                    <input type='hidden' name='JobID' value='".$row["JobID"]."'>
                                    <button type='submit'>Delete</button>
                                    </form></td></tr>";
                                }
                            }
                            echo "</table>";
                        } else {
                            echo "<table><tr><td>No job records found for this customer.</td></tr></table>";
                        }
                    }
                }
                else{
                    // Display table of job records with delete buttons
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table><tr><th>Job Done</th><th>Date of Job</th><th>Job Cost</th><th>Delete</th></tr>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["JobDone"] . "</td>";
                            echo "<td>" . $row["DateofJob"] . "</td>";
                            echo "<td>" . $row["JobCost"] . "</td><td>
                            <form method='post' action='delete-job-record.php'>
                            <input type='hidden' name='JobID' value='".$row["JobID"]."'>
                            <button type='submit'>Delete</button>
                            </form></td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<table><tr><td>No job records found for this customer.</td></tr></table>";
                    }
                }

                mysqli_close($sqlConnect);
        } else {
            echo "<table><tr><td>No record ID provided.</td></tr></table>";
        }
?>
</body>
</html>