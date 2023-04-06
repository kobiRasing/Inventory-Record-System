<html>
    <h3>
        Add Existing Record of Customer
    </h3>
    <body>
        <?php
            // open connection to mysql
            $sqlConnect = mysqli_connect('localhost','root','');
            if(!$sqlConnect) die("Failed to connect to the database");

            // choose the database
            $dbName = 'inventory_system';
            $selectDB = mysqli_select_db($sqlConnect,$dbName);
            if(!$selectDB) die("Failed to select the following databaseL: " . $dbName);

            // retrieve customer_record_table from sql and create dropdown list
            $customerRecordList = mysqli_query($sqlConnect, "SELECT * FROM customer_record_table ORDER BY CustomerName");
            echo "<form action = 'add-existing-record.php' method = 'post'>";
                echo "Customer List: ";
                echo "<select name = 'selectedCustomer'>"; // yung name neto gagamitin sa $_POST['selectedCustomer'] para makuha kung alin yung pinili sa dropdown
                    echo "<option value = ''> ------SELECT CUSTOMER------ </option>";
            while($customer = mysqli_fetch_array($customerRecordList)){
                    echo "<option value = '$customer[CustomerName]'> " . $customer['CustomerName'] . "</option>" ; // value yung nagdidisplay ng name sa dropdown
            }
            echo "</select>";
            mysqli_close($sqlConnect);
        ?>

        <form action = 'add-existing-record.php' method = 'post'>
            <br>Current Date (yyy-mm-dd): <input type = 'text' name = 'new-date' /><br>
            Job Done: <input type = 'text' name = 'new-job-done' /><br>
            Cost of Job: <input type = 'text' name = 'new-job-cost' /><br>
            <input type = 'submit' value = 'Add Record' name = 'add-record' /><br> 
        </form>
        <form action = 'main-menu-employee.php' method = 'post'>
            <input type = 'submit' value = 'Back to Main Menu' /><br> 
        </form>

        <?php
            if(isset($_POST['add-record'])){
                if(!empty($_POST['new-date']) && !empty($_POST['new-job-done']) && !empty($_POST['new-job-cost']) && $_POST['selectedCustomer'] != ''){
                    // open connection to mysql
                    $sqlConnect = mysqli_connect('localhost','root','');
                    if(!$sqlConnect) die("Failed to connect to the database");

                    // choose the database
                    $dbName = 'inventory_system';
                    $selectDB = mysqli_select_db($sqlConnect,$dbName);
                    if(!$selectDB) die("Failed to select the following databaseL: " . $dbName);
                    
                    $newDate = $_POST['new-date'];
                    $newJobDone = $_POST['new-job-done'];
                    $newJobCost = $_POST['new-job-cost'];
                    $chosenCustomer = $_POST['selectedCustomer'];

                    // get id of chosen customer in dropdown list
                    $getNewId = "SELECT * FROM customer_record_table";
                    $newIdList = mysqli_query($sqlConnect,$getNewId);
                    while($row = mysqli_fetch_array($newIdList)){
                        if($row['CustomerName'] == $chosenCustomer){
                            $newId = $row['RecordID'];
                        }
                    }

                    // enter the information to job_record_table since nakuha na yung id
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