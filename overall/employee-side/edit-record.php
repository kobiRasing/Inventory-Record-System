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
    $RecordID = $_POST['RecordID'];
    $CustomerName = $_POST['CustomerName'];
    $CarModel = $_POST['CarModel'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $PlateNumber = $_POST['PlateNumber'];

    // Update staff record in database
    $sql = "UPDATE customer_record_table SET
                CustomerName = '$CustomerName',
                CarModel = '$CarModel',
                PhoneNumber = '$PhoneNumber',
                PlateNumber = '$PlateNumber'
                WHERE RecordID = '$RecordID'";
    $result = mysqli_query($sqlConnect, $sql);

    if ($result) {
        // Redirect back to view-record-employee.php
        header('Location: view-record-employee.php');
        exit;
    } else {
        echo "Failed to update customer record: " . mysqli_error($sqlConnect);
    }

    // Close connection to MySQL
    mysqli_close($sqlConnect);
} else {
    // Form not submitted, redirect back to view-record-employee.php
    header('Location: view-record-employee.php');
    exit;
}
?>