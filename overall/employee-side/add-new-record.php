<html>
<head>
    <title> Autofrost - Record Management System </title>
    <link rel = "stylesheet" type = "text/css" href = "../css/newrecord.css"/>
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id="newrecordBody">
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

    <div class="container">
        <div class="newrecordHeader">
            <h1>AUTOFROST</h1>
            <h3>Add New Record</h3>
        </div>
        
        <div class="newrecordBody">
            <form action = 'add-new-record.php' method = 'post'>
                Current Date (yyyy-mm-dd): <input type = 'text' name = 'new-date' /><br>
                Name of Customer: <input type = 'text' name = 'new-customer-name' /><br>
                Car Model: <input type = 'text' name = 'new-car-model' /><br>
                Phone Number: <input type = 'text' name = 'new-phone-number' /><br>
                Plate Number: <input type = 'text' name = 'new-plate-number' /><br>
                Job Done: <input type = 'text' name = 'new-job-done' /><br>
                Cost of Job: <input type = 'text' name = 'new-job-cost' /><br> <br>
                <div class="btn-group">
                    <button type="submit" name="add-record">Add Record</button>
                </div>
            </form>

            <form action = 'main-menu-employee.php' method = 'post'>
                <div class="btn-group">
                        <button type="submit">Back to Main Menu</button>
                </div> 
            </form>
            <div class="error"> </div>
        </div>


        <?php
            if(isset($_POST['add-record'])){
                if(!empty($_POST['new-date']) && !empty($_POST['new-customer-name']) && !empty($_POST['new-car-model']) && 
                    !empty($_POST['new-phone-number']) && !empty($_POST['new-plate-number']) && !empty($_POST['new-job-done'])
                    && !empty($_POST['new-job-cost'])){
                    // open connection to mysql
                    $sqlConnect = mysqli_connect('localhost','root','');
                    if(!$sqlConnect)
                        die("Failed to connect to the database");

                    // choose the database
                    $dbName = 'inventory_system';
                    $selectDB = mysqli_select_db($sqlConnect,$dbName);
                    if(!$selectDB) 
                        die("Failed to select the following databaseL: " . $dbName);
                    
                    $newDate = $_POST['new-date'];
                    $newCustomerName = $_POST['new-customer-name'];
                    $newCarModel = $_POST['new-car-model'];
                    $newPhoneNumber = $_POST['new-phone-number'];
                    $newPlateNumber = $_POST['new-plate-number'];
                    $newJobDone = $_POST['new-job-done'];
                    $newJobCost = $_POST['new-job-cost'];

                    // enter information muna sa customer_record_table para magkaroon ng id 
                    $enterNewInfo = "INSERT INTO customer_record_table(CustomerName,CarModel,PhoneNumber,PlateNumber)
                        VALUES('$newCustomerName','$newCarModel','$newPhoneNumber', '$newPlateNumber')";
                    
                    // enter information to database
                    mysqli_query($sqlConnect,$enterNewInfo);

                    // get the last id generated
                    $getNewId = "SELECT * FROM customer_record_table ORDER BY RecordID DESC LIMIT 1";
                    $newIdList = mysqli_query($sqlConnect,$getNewId);
                    while($row = mysqli_fetch_array($newIdList)){
                        $newId = $row['RecordID'];
                    }

                    // enter the rest of the information to job_record_table since nakuha na yung id
                    $enterJobInfo = "INSERT INTO job_record_table(RecordID,DateOfJob,JobDone,JobCost)
                        VALUES('$newId','$newDate','$newJobDone','$newJobCost')";
                    
                    // enter information to database
                    mysqli_query($sqlConnect,$enterJobInfo);

                    echo "Registration Successful!";
                    mysqli_close($sqlConnect);
                }
                else echo "Make sure all fields are filled up.";
            }
        ?>

    </body>
</html>