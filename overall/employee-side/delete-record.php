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
    $RecordID = $_POST['RecordID'];

    // delete the record from the job_record_table
    $sql = "DELETE FROM customer_record_table WHERE RecordID = '$RecordID'";
    $result = mysqli_query($sqlConnect, $sql);

    // check if the record was successfully deleted
    if ($result) {
        header("Location: view-record-employee.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($sqlConnect);
    }

    mysqli_close($sqlConnect);
?>