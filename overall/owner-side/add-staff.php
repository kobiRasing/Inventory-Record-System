<html>
    <h3>
        Add Staff
    </h3>
    <body>
        <form action = 'add-staff.php' method = 'post'>
            Name: <input type = 'text' name = 'new-staff-name' /><br>
            Phone Number: <input type = 'text' name = 'new-staff-phone-number' /><br>
            Age: <input type = 'number' name = 'new-staff-age' /><br>
            Address: <input type = 'text' name = 'new-staff-address' /><br>
            Birthday (yyyy-mm-dd): <input type = 'text' name = 'new-staff-birthday' /><br>
            <input type = 'submit' name = 'add-staff' value = 'Add Staff' />
        </form>

        <?php
            if(isset($_POST['add-staff'])){
                if(!empty($_POST['new-staff-name']) && !empty($_POST['new-staff-phone-number']) && !empty($_POST['new-staff-age'])
                    && !empty($_POST['new-staff-address']) && !empty($_POST['new-staff-birthday'])){
                    //open the connection
                    $sqlConnect = mysqli_connect('localhost','root','');
                    if(!$sqlConnect){
                        die("Failed to connect to MySQL");
                    }

                    //choose the database
                    $selectDB = mysqli_select_db($sqlConnect, 'inventory_system');
                    if(!$selectDB){
                        die("Failed to connect to the database");
                    }

                    $newName = $_POST['new-staff-name'];
                    $newNumber = $_POST['new-staff-phone-number'];
                    $newAge = $_POST['new-staff-age'];
                    $newAddress = $_POST['new-staff-address'];
                    $newBirthday = $_POST['new-staff-birthday'];

                    $enterData = "INSERT INTO staff_info_table(StaffName, StaffPhoneNumber, StaffAddress, StaffAge, StaffBirthday)
                        VALUES('$newName','$newNumber','$newAddress','$newAge','$newBirthday')";
                    mysqli_query($sqlConnect,$enterData);
                    echo "Registration Successful!";

                    mysqli_close($sqlConnect);
                }
                else{
                    echo "Make sure all required fields are filled up!";
                }
            }
        ?>

    </body>
</html>