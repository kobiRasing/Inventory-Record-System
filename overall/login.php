<html>
<head>
    <title> Autofrost - Record Management System </title>
    <link rel = "stylesheet" type = "text/css" href = "css/login.css"/>
    <link rel = "icon" type = "image/png" href = "css/images/ico.png"/>
</head>

<body id="loginBody">
    <div class="container">
        <div class="loginHeader">
            <h1>AUTOFROST</h1>
            <h3>Record Management System</h3>
        </div>

        <div class="loginBody">
            <form action='login.php' method='post'>
                <div class="input-group">
                    <label for="">Username</label>
                    <input placeholder="Username" type="text" name="user"/>
                </div>

                <div class="input-group">
                    <label for="">Password</label>
                    <input placeholder="Password" type="password" name="pass"/>
                </div>

                <div class="btn-group">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>

            <form action='sign-up.php' method='post'>
                <div class="btn-group">
                    <button type="submit" name="login">Employee Sign up</button>
                </div>
            </form>

            <div class="error"> </div>
        </div>

    <?php
        if(isset($_POST['login'])){
            // open connection to mysql
            $sqlConnect = mysqli_connect('localhost','root','');
            if(!$sqlConnect) 
                die("Failed to connect to the database");

            // choose the database
            $dbName = 'inventory_system';
            $selectDB = mysqli_select_db($sqlConnect,$dbName);
            if(!$selectDB) 
                die("Failed to select the following databaseL: " . $dbName);

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
            mysqli_close($sqlConnect);
        }
    ?>
</body>
</html>