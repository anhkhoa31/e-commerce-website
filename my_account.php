<?php
    session_start();
    require("data_handler.php");
    $file_path = "accounts.db";

    if (!isset($_SESSION['logged_user'])) {
        // echo "<script>location.href='login.php'</script>";
        header('location: login.php');
    } else {
        
        $logged_user = $_SESSION['logged_user'];
        $username = $logged_user['username'];
        $profile_img_path = $logged_user['profile_image'];
        $user_role = $logged_user['role'];
    }

    if (isset($_POST['update_profile'])) {
        if(isset($_FILES['new_profile_image'])){
            $check = 1;
            $file_name = $_FILES['new_profile_image']['name'];
            $file_tmp = $_FILES['new_profile_image']['tmp_name'];
            $file_name_array = explode('.', $file_name);
            $file_extension = end($file_name_array);
            
            if ($file_tmp == null) {
                $_SESSION['update_profile'] = 'null image';
                $check = 0;
            }
            // $check = getimagesize($file_tmp);
            // if($check !== false) {
            //     echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = 1;
            // } else {
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }
            if ($check == 1) {
                $old_img = $_SESSION['logged_user']['profile_image'];
                $new_img = "uploads/".$logged_user['username'] . "." . $file_extension;
                $profile_img_path = $new_img;
                $_SESSION['logged_user']['profile_image'] = $profile_img_path;
                unlink($old_img);
                move_uploaded_file($file_tmp, $profile_img_path);
                update_user($username, 'profile_image', $profile_img_path, $file_path);
                $_SESSION['update_profile'] = 'success';
            }
         }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="my_account.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content" id="my_account_page">
        <div class="container">
            <h1>Welcome <?php echo $username?></h1>
            <div class="form_container">
                <?php
                    echo 
                    "<form class='form_title' action='my_account.php' method='post' enctype='multipart/form-data'>
                        <div class='form_item_profile'>
                            <label for='select_btn'><img src='$profile_img_path' alt='profile picture' id='profile_img'></label>
                            <label for='select_btn' id='select_img_label'>Change</label>
                        </div>
                        <input class='form_item' type='file' name='new_profile_image' id='select_btn'>
                        
                        <input class='btn form_item' type='submit' value='Confirm update' name='update_profile' id='update_btn'>
                    </form>
                    <div class='form_body'>
                        <div class='form_item_group'>
                            <div class='form_item label'>Username:</div>
                            <div class='form_item infor'>$username</div>
                        </div>
                        <div class='form_item_group'>
                            <div class='form_item label'>Role:</div>
                            <div class='form_item infor'>$user_role</div>
                        </div>"
                ?>
                <?php
                    if ($user_role == "customer") {
                        $name = $logged_user['name'];
                        $address = $logged_user['address'];

                        echo "
                            <div class='form_item_group'>
                                <div class='form_item label'>Name:</div>
                                <div class='form_item infor'>$name </div>
                            </div>
                            <div class='form_item_group'>
                                <div class='form_item label'>Address:</div>
                                <div class='form_item infor'>$address </div>
                            </div>
                        </div>";
                    }
                    if ($user_role == "vendor") {
                        $business_name = $logged_user['business_name'];
                        $business_address = $logged_user['business_address'];
                        echo "
                            <div class='form_item_group'>
                                <div class='form_item label'>Business name:</div>
                                <div class='form_item infor'>$business_name </div>
                            </div>
                            <div class='form_item_group'>
                                <div class='form_item label'>Business address:</div>
                                <div class='form_item infor'>$business_address </div>
                            </div>
                        </div>";
                    }
                    if ($user_role == "shipper") {
                        $distribution_hub_name = $logged_user['distribution_hub_name'];
                        $distribution_hub_address = $logged_user['distribution_hub_address'];
                        echo "
                            <div class='form_item_group'>
                                <div class='form_item label'>Distribution hub name:</div>
                                <div class='form_item infor'>$distribution_hub_name </div>
                            </div>
                            <div class='form_item_group'>
                                <div class='form_item label'>Distribution hub address:</div>
                                <div class='form_item infor'>$distribution_hub_address </div>
                            </div>
                        </div>";
                    }
                echo 
                "<a href='logout_handler.php' class='nav_btn'>Logout</a>";
                ?>
            </div>
        </div>
    </div>
    <?php
        require("dialog.php");
        if (isset($_SESSION['update_profile']) && $_SESSION['update_profile'] == 'success') {
            $message = 'Successfully updated';
            show_dialog('success', $message);
        }
        if (isset($_SESSION['update_profile']) && $_SESSION['update_profile'] == 'null image') {
            $message = 'Null input! Failed to update profile image';
            show_dialog('error', $message);
        }
    ?>
    <?php
    require_once("footer.php");
    ?>
    <script src="my_account.js"></script>
    <script src="dialog.js"></script>
    <script src="header.js"></script>
</body>
</html>