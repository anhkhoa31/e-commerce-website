<?php
session_start();
require("data_handler.php");
$file_path = "accounts.db";
// $data = fetch_user_data($file_path);
function is_valid_login($input_username, $input_password) {
    if ($input_username == '' || $input_password == '') {
        return false;
    }
    $file_path = "accounts.db";
    $data = fetch_user_data($file_path);
    foreach ($data as $user) {
        $username = $user['username'];
        $encrypted_pwd = $user['password'];
        if ($input_username == $username && password_verify($input_password, $encrypted_pwd)) {
            return true;
        }
    }
    return false;
}

if (isset($_POST['login'])) {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    if (is_valid_login($input_username, $input_password)) {
        $logged_user = get_user($input_username, $file_path);
        $_SESSION['logged_user'] = $logged_user;
        $_SESSION['response'] = "login_success";
    } else {
        $_SESSION['response'] = "login_failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content" id="login_page">
        <div class="container">
            <form action="login.php" method="post" class="form_container">
                <div class="form_title">
                    <h1>Login</h1>
                </div>
                <div class="form_body">
                    <div class="form_item_group">
                        <label for="username" class="form_item">Username</label>
                        <input type="text" name="username" class="form_item" id="username" placeholder="Username" required>
                    </div>
                    <div class="form_item_group">
                        <label for="password" class="form_item" >Password</label>
                        <input type="password" name="password" class="form_item" id="password" placeholder="Password" required>
                    </div>
                    <div class="form_item_group">
                        <input type="submit" value="Login" name="login" class="form_item nav_btn">
                    </div>
                    <div class="form_item_group">
                        Not a member? &nbsp;<a href="registerpage.php">Register now</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        require('dialog.php');
        if (isset($_POST['login']) && $_SESSION['response'] == 'login_success') {
            echo "<script>location.href='my_account.php'</script>";
        }
        if (isset($_POST['login']) && $_SESSION['response'] == 'login_failed') {
            $message = "Invalid username or password";
            show_dialog('error', $message);
        }
    ?>
    <?php
        require_once("footer.php");
    ?>
    <script src='dialog.js'></script>
    <script src="header.js"></script>
    <!-- <footer>
        <nav class="footer">
            <ul>
                <li><a href="about.php">About</a></li>
                <li><a href="copyright.php">Copyright</a></li>
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="help.php">Help</a></li>
            </ul>
        </nav>
    </footer> -->
</body>

</html>