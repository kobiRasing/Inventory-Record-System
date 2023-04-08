<!DOCTYPE html>
<html>
<head>
    <title> Autofrost - Record Management System </title>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <link rel="icon" type="image/png" href="css/images/ico.png"/>
</head>

<body id="loginBody">
    <?php
        if(isset($_POST['login'])){
            $input_user = trim($_POST['user']); // trim to remove extra whitespace
            $input_pass = trim($_POST['pass']);

            if(empty($input_user) || empty($input_pass)){
                $errorMessage = "Both username and password fields are required.";
            }else{
                // open connection to mysql
                $sqlConnect = mysqli_connect('localhost','root','','inventory_system');
                if(!$sqlConnect) 
                    die("Failed to connect to the database");

                // retrieve account from sql
                $account = mysqli_query($sqlConnect, "SELECT * FROM accounts_table WHERE Username='$input_user' AND Password='$input_pass' LIMIT 1");

                if(mysqli_num_rows($account) == 1){ // check if account exists
                    $accountData = mysqli_fetch_assoc($account);
                    if($accountData['IsOwner']){
                        header("Location: owner-side/main-menu-owner.php");
                        exit();
                    }
                    else{
                        header("Location: employee-side/main-menu-employee.php");
                        exit();
                    }
                }else{
                    $errorMessage = "Invalid username or password.";
                }
                mysqli_close($sqlConnect);
            }
        }
    ?>

    <div class="container">
        <div class="loginHeader">
            <h1>AUTOFROST</h1>
            <h3>Record Management System</h3>
        </div>

        <div class="loginBody">
            <form action="login.php" method="post">
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

            <form action="sign-up.php" method="post">
                <div class="btn-group">
                    <button type="submit" name="signup">Employee Sign up</button>
                </div>
            </form>

            <?php if(isset($errorMessage)): ?>
                <div class="error">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>