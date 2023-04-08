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
    $staffID = $_POST['StaffID'];
    $staffName = $_POST['StaffName'];
    $staffPhoneNumber = $_POST['StaffPhoneNumber'];
    $staffAddress = $_POST['StaffAddress'];
    $staffAge = $_POST['StaffAge'];
    $staffBirthday = $_POST['StaffBirthday'];

    // Update staff record in database
    $sql = "UPDATE staff_info_table SET
                StaffName = '$staffName',
                StaffPhoneNumber = '$staffPhoneNumber',
                StaffAddress = '$staffAddress',
                StaffAge = '$staffAge',
                StaffBirthday = '$staffBirthday'
                WHERE StaffID = '$staffID'";
    $result = mysqli_query($sqlConnect, $sql);

    if ($result) {
        // Redirect back to view-staff-owner.php
        header('Location: view-staff-owner.php');
        exit;
    } else {
        echo "Failed to update staff record: " . mysqli_error($sqlConnect);
    }

    // Close connection to MySQL
    mysqli_close($sqlConnect);
} else {
    // Form not submitted, redirect back to view-staff-owner.php
    header('Location: view-staff-owner.php');
    exit;
}
?>