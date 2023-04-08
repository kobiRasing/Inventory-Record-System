<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Open connection to MySQL
    $sqlConnect = mysqli_connect('localhost', 'root', '');
    if (!$sqlConnect) {
        die("Failed to connect to the database");
    }

    // Choose the database
    $dbName = 'inventory_system';
    $selectDB = mysqli_select_db($sqlConnect, $dbName);
    if (!$selectDB) {
        die("Failed to select the following database: " . $dbName);
    }

    // Get staff data from form
    $JobID = $_POST['JobID'];
    $RecordID = $_POST['RecordID'];
    $DateOfJob = $_POST['DateOfJob'];
    $JobDone = $_POST['JobDone'];
    $JobCost = $_POST['JobCost'];

    // Update staff record in database
    $sql = "UPDATE job_record_table SET
                DateOfJob = '$DateOfJob',
                JobDone = '$JobDone',
                JobCost = '$JobCost'
                WHERE JobID = '$JobID'";
    $result = mysqli_query($sqlConnect, $sql);

    if ($result) {
        // Redirect back to view-jobs-owner.php
        header('Location: view-record-owner.php');
        exit;
    } else {
        echo "Failed to update customer record: " . mysqli_error($sqlConnect);
    }

    // Close connection to MySQL
    mysqli_close($sqlConnect);
} else {
    // Form not submitted, redirect back to view-jobs-owner.php
    header('Location: view-record-owner.php');
    exit;
}
?>