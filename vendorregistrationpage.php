<?php
session_start();
require("data_handler.php");
$file_path = "accounts.db";

function is_valid_registration($file_path)
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $business_name = $_POST['business_name'];
    $business_address = $_POST['business_address'];
    $error = "";

    if ($username == "" || $password == "") {
        $error = "The username and password can not be empty!";
        return $error;
    }
    if (get_user($username, $file_path) !== false) {
        $error = "The username has already existed!";
        return $error;
    }
    // Check bussiness name and address
    $vendors = get_vendor_user($file_path);
    foreach ($vendors as $vendor) {
        if ($vendor['business_name'] == $business_name) {
            $error = "The business name has already existed!";
            return $error;
        }
    }

    foreach ($vendors as $vendor) {
        if ($vendor['business_address'] == $business_address) {
            $error = "The business address has already existed!";
            return $error;
        }
    }

    return true;
}

if (isset($_POST['submit-button'])) {
    if (is_valid_registration($file_path) === true) {
        $encrypted_pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_data = [
            "role" => "vendor",
            "username" => $_POST['username'],
            "password" => $encrypted_pwd,
            "business_name" => $_POST['business_name'],
            "business_address" => $_POST['business_address']
        ];

        if (isset($_FILES['profile_image'])) {
            $check = 1;
            $file_name = $_FILES['profile_image']['name'];
            $file_tmp = $_FILES['profile_image']['tmp_name'];
            $file_name_array = explode('.', $file_name);
            $file_extension = end($file_name_array);
            $target_path = "uploads/" . $_POST['username'] . "." . $file_extension;

            if ($file_tmp == null) {
                $_SESSION['error'] = 'Invalid image';
                $check = 0;
            }

            if ($check == 1) {
                move_uploaded_file($file_tmp, $target_path);
                $user_data['profile_image'] = $target_path;
            }
        } else {
            $_SESSION['error'] = 'The profile image is empty!';
        }

        if (!isset($_SESSION['error'])) {
            add_user($user_data, $file_path);
        }
    } else {
        $_SESSION['error'] = is_valid_registration($file_path);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="registrationpage.css">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <title>Register</title>
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content">
        <div class="container">
            <h1 class="form-title">Registration Form for Vendor</h1>
            <form method="post" action="vendorregistrationpage.php" enctype="multipart/form-data" id="register-form" name="register-form">
                <div class="form-body">
                    <div class="form-field">
                        <label for="username">Username:</label>
                        <input class="form_item" id="username" type="text" placeholder="Enter your username" name="username" required minlength="8" maxlength="20">
                    </div>
                    <div class="form-field">
                        <label for="password">Password:</label>
                        <input class="form_item" id="password" type="password" placeholder="Enter your password" name="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,20}$" title="Password length must be between 8-20 characters and must include at least 1 uppercase character, 1 lowercase character, and 1 number.">
                    </div>
                    <div class="form-field">
                        <label for="profile_image">Choose your profile picture:</label>
                        <input class="form_item" required type="file" name="profile_image" id="image">
                    </div>
                    <div class="form-field">
                        <label for="business_name">Business name:</label>
                        <input class="form_item" id="business_name" type="text" placeholder="Enter your business name" name="business_name" required minlength="5">
                    </div>
                    <div class="form-field">
                        <label for="business_address">Business address:</label>
                        <input class="form_item" id="business_address" type="text" placeholder="Enter your business address" name="business_address" required minlength="8">
                    </div>
                    <div class="form-submit-button">
                        <a class="btn" href="registerpage.php">Back</a>
                        <input class="btn" type="submit" id="submit-button" name="submit-button" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
    <?php
    require("dialog.php");
    if (isset($_SESSION['error'])) {
        $message = $_SESSION['error'];
        show_dialog('error', $message);
        unset($_SESSION['error']);
    }
    if (isset($POST['submit-button']) && !isset($_SESSION['error'])) {
        $message = "Successfully registered";
        show_dialog('success', $message);
    }
    ?>
    <script src="header.js"></script>
    <script src="dialog.js"></script>
</body>

</html>