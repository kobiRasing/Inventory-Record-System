<html>
<head>
    <title> Autofrost - Record Management System </title>
    <link rel = "stylesheet" type = "text/css" href = "css/signup.css"/>
    <link rel = "icon" type = "image/png" href = "css/images/ico.png"/>
</head>

<body id="signupBody">
    <div class="container">
        <div class="signupHeader">
            <h1>AUTOFROST</h1>
            <h3>Record Management System</h3>
        </div>

        <div class="signupBody">
            <form action = 'sign-up.php' method = 'post'>
                Full Name: <input type = 'text' name = 'new-name' /><br>
                Username: <input type = 'text' name = 'new-user' /><br>
                Phone Number: <input type = 'text' name = 'new-phone-number' /><br>
                Password: <input type = 'password' name = 'new-pass' /><br>
                Confirm Password: <input type = 'password' name = 'confirm-new-pass' /><br> <br>
                <div class="btn-group">
                    <button type="submit" name="signup">Sign Up</button>
                </div>
            </form>

            <form action = 'login.php' method = 'post'>
                <div class="btn-group">
                    <button type="submit">Already have an account?</button>
                </div>
            </form>
            <div class="error"> </div>
        </div>

        <?php
            if(isset($_POST['signup'])){
                if(!empty($_POST['new-name']) && !empty($_POST['new-user']) && !empty($_POST['new-phone-number']) && 
                    !empty($_POST['new-pass'])){
                    if($_POST['confirm-new-pass'] == $_POST['new-pass']){
                        // open connection to mysql
                        $sqlConnect = mysqli_connect('localhost','root','');
                        if(!$sqlConnect) 
                            die("Failed to connect to the database");

                        // choose the database
                        $dbName = 'inventory_system';
                        $selectDB = mysqli_select_db($sqlConnect,$dbName);
                        if(!$selectDB) 
                            die("Failed to select the following databaseL: " . $dbName);
                        
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
                        mysqli_close($sqlConnect);
                    }
                    else echo "Password does not match";
                }
                else echo "Make sure all fields are filled up.";
            }
        ?>
    </body>
</html>