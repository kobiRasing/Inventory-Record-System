<?php
    // open connection to mysql
    $sqlConnect = mysqli_connect('localhost', 'root', '');
    if (!$sqlConnect) {
        die("Failed to connect to the database");
    }

    // choose the database
    $dbName = 'inventory_system';
    $selectDB = mysqli_select_db($sqlConnect, $dbName);
    if (!$selectDB) {
        die("Failed to select the following databaseL: " . $dbName);
    }

    // retrieve RecordID and JobDone values from the form
    $StaffID = $_POST['StaffID'];

    // delete the record from the staff_info_table
    $sql = "DELETE FROM staff_info_table WHERE StaffID = '$StaffID'";
    $result = mysqli_query($sqlConnect, $sql);

    // check if the record was successfully deleted
    if ($result) {
        header("Location: view-staff-owner.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($sqlConnect);
    }

    mysqli_close($sqlConnect);
?>