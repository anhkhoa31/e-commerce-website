<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" type="text/css" href="registrationpage.css">
    </head>
    <body>
        <?php
        require_once("header.php");
        ?>
        <div class='main_content'>
            <h1 class="form-title">Please choose your role to register</h1>
            <a href="vendorregistrationpage.php"><button type="button" class="nav_btn" value="Vendor" class="vendorregister">Vendor<br><img src='./images/vendor.png'></button></a>
            <a href="customerregistrationpage.php"><button type="button" class="nav_btn" value="Customer" class="customerregister">Customer<br><img src='./images/customer.png'></button></a>
            <a href="shipperregistrationpage.php"><button type="button" class="nav_btn" value="Shipper" class="shipperregister">Shipper<br><img src='./images/shipper.png'></button></a>
        </div>
        
        <?php
            require_once("footer.php");
        ?>
    </body> 
</html>
