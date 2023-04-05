<html>
    <h3>
        Login Page
    </h3>
    <body>
        <form action = 'login.php' method = 'post'>
            Username: <input type = 'text' name = 'user' /><br>
            Password: <input type = 'password' name = 'pass' /><br>
            <input type = 'submit' value = 'Login' name = 'login' /><br> 
        </form>
        <form action = 'sign-up.php' method = 'post'>
            <input type = 'submit' value = 'Go to Sign Up' /><br> 
        </form>

        <?php
            if(isset($_POST['login'])){
                // open connection to mysql
                $sqlConnect = mysqli_connect('localhost','root','');
                if(!$sqlConnect) die("Failed to connect to the database");

                // choose the database
                $dbName = 'inventory_system';
                $selectDB = mysqli_select_db($sqlConnect,$dbName);
                if(!$selectDB) die("Failed to select the following databaseL: " . $dbName);

                $input_user = $_POST['user'];
                $input_pass = $_POST['pass'];

                // retrieve accounts_table from sql
                $accountList = mysqli_query($sqlConnect, "SELECT * FROM accounts_table");

                // determine if user exists
                // if exists, determine if owner or employee
                while($account = mysqli_fetch_array($accountList)){
                    if($input_user == $account['Username'] && $input_pass == $account['Password']){
                        if($account['IsOwner']){
                            header("Location: owner-side/main-menu-owner.php");
                            exit();
                        }
                        else{
                            header("Location: employee-side/main-menu-employee.php");
                            exit();
                        }
                    }
                }
                echo "Account not in database";
            }
        ?>
    </body>
</html>