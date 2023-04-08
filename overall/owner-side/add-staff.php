<html>
<head>
    <title> Autofrost - Add Staff</title>
    <link rel = "stylesheet" type = "text/css" href = "../css/newrecord.css"/>
    <link rel = "icon" type = "image/png" href = "../css/images/ico.png"/>
</head>

<body id="newrecordBody">
    <nav>
        <ul>
            <li onclick="location.href='main-menu-owner.php';">Home</li>
            <li onclick="location.href='add-new-record.php';">Add New Record</li>
            <li onclick="location.href='add-existing-record.php';">Add Existing Record</li>
            <li onclick="location.href='view-record-owner.php';">Customer Records</li>
            <li onclick="location.href='add-staff.php';">Add Staff</li>
            <li onclick="location.href='view-staff-owner.php';">Manage Staff</li>
            <li onclick="location.href='../login.php';">Logout</li>
            <img src="../css/images/ico.png" alt="Logo"onclick="location.href='main-menu-owner.php';">
        </ul>
    </nav>

    <div class="container">
        <div class="newrecordHeader">
            <h1>AUTOFROST</h1>
            <h3>Add Staff Information</h3>
        </div>
        
    <div class="newrecordBody">
        <form action = 'add-staff.php' method = 'post'>
            Name: <input type = 'text' placeholder="Name" name = 'new-staff-name' /><br>
            Phone Number: <input type = 'text' placeholder="Phone Number" name = 'new-staff-phone-number' /><br>
            Age: <input type = 'number' placeholder="Age" name = 'new-staff-age' /><br>
            Address: <input type = 'text' placeholder="Address" name = 'new-staff-address' /><br>
            Birthday (yyyy-mm-dd): <input type = 'text' placeholder="Birthday" name = 'new-staff-birthday' /><br> <br>
            <div class="btn-group">
                    <button type="submit" name="add-staff">Add Staff</button>
            </div>
        </form>

        <form action = 'main-menu-owner.php' method = 'post'>
            <div class="btn-group">
                    <button type="submit">Back to Main Menu</button>
                </div> 
            </form>
            <div class="error">
        </div>

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
                    echo "Staff Added Successful!";

                    mysqli_close($sqlConnect);
                }
                else{
                    echo "Make sure all required fields are filled up!";
                }
            }
        ?>

    </body>
</html>