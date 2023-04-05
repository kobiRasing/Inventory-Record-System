<html>
    <h3>
        Sign Up As Employee
    </h3>
    <body>
        <form action = 'sign-up.php' method = 'post'>
            Full Name: <input type = 'text' name = 'new-name' /><br>
            Username: <input type = 'text' name = 'new-user' /><br>
            Phone Number: <input type = 'text' name = 'new-phone-number' /><br>
            Password: <input type = 'password' name = 'new-pass' /><br>
            Confirm Password: <input type = 'password' name = 'confirm-new-pass' /><br>
            <input type = 'submit' value = 'Sign Up' name = 'signup' /><br> 
        </form>
        <form action = 'login.php' method = 'post'>
            <input type = 'submit' value = 'Go to Log In' /><br> 
        </form>

        <?php
            if(isset($_POST['signup'])){
                if(!empty($_POST['new-name']) && !empty($_POST['new-user']) && !empty($_POST['new-phone-number']) && 
                    !empty($_POST['new-pass'])){
                    if($_POST['confirm-new-pass'] == $_POST['new-pass']){
                        // open connection to mysql
                        $sqlConnect = mysqli_connect('localhost','root','');
                        if(!$sqlConnect) die("Failed to connect to the database");

                        // choose the database
                        $dbName = 'inventory_system';
                        $selectDB = mysqli_select_db($sqlConnect,$dbName);
                        if(!$selectDB) die("Failed to select the following databaseL: " . $dbName);
                        
                        $newName = $_POST['new-name'];
                        $newUser = $_POST['new-user'];
                        $newPhoneNumber = $_POST['new-phone-number'];
                        $newPassword = $_POST['new-pass'];

                        // query to enter information to database
                        $enterNewInfo = "INSERT INTO accounts_table(Name, Username, Password, PhoneNumber)
                            VALUES('$newName','$newUser','$newPassword','$newPhoneNumber')";
                        
                        // enter information to database
                        mysqli_query($sqlConnect,$enterNewInfo);
                        echo "Registration Successful. Go Back to Login Page.";
                    }
                    else echo "Password does not match";
                }
                else echo "Make sure all fields are filled up.";
            }
        ?>
    </body>
</html>