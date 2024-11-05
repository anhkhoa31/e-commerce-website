<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help center</title>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="help.css">
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content" id="help_page">
        <div class="container">
            <h1>Help center</h1>
            <div class="container" id="help_page_body">
                <div class="form_container" id="account_topic">
                    <div class="form_item">
                        <h3>Account management</h3>
                        <h4>1. How do I register for a Lazada account?</h4>
                        <p>Registering for a Lazada account is fast and easy!</p>
                        <p>User can join our app as one of the following roles: Customer, Shipper and Vendor</p>
                        <ol>
                            <li>Step 1: Go to our <a href="./register.php">Register page</a> or click <strong>Register</strong> button on the header navigation bar.</li>
                            <li>Step 2: Fill in the register form</li>
                            <li>Step 3: Confirm registeration</li>
                        </ol>
                        <h4>2. Account profile</h4>
                        <p>After having logged in, you can observe and manage your profile in <strong>My account</strong> page.</p>
                    </div>

                </div>
                <div class="form_container" id="contact_topic">
                    <div class="form_item">
                        <h3>Contact</h3>
                        <h4>1. How to contact us?</h4>
                        <p>You can also contact us via the hotline 1900 6509 (1,000 VND per minute) for support.
                            However, you might have to wait a bit longer due to the high number of calls, so please prioritize the above ways. Thank you very much for your understanding!</p>
                    </div>
                </div>
                <div class="form_container" id="privacy_topic">
                    <div class="form_item">
                        <h3>Data privacy</h3>
                        <h4>1. What is your privacy policy?</h4>
                        <p>We take your privacy seriously. We are committed to complying with all data protection/privacy laws as are applicable to us.

                            The Privacy Policy exists to keep you informed about how we collect, use, disclose and/or process the data we collect and receive. We will only collect, use, disclose and/or process your personal data in accordance with this Privacy Policy.
                        </p>
                        <p>Please click on the link for our <a href="./privacy.php">Privacy Policy</a></p>
                        <h4>2. What kind of personal data does your website collect from me?</h4>
                        <p>During your use of our website/mobile application and our provision of services to you, we may collect the following personal data from you:
                        <ul>
                            <li>Identity data</li>
                            <li>Contact data</li>
                            <li>Account data</li>
                            <li>Transaction data</li>
                            <li>Technical data</li>
                            <li>Transaction data</li>
                            <li>Usage data</li>
                            <li>Usage data</li>
                            <li>Biometric data</li>
                            <li>Marketing and communications data.</li>
                        </ul>
                        </p>
                        <p>
                            For more details, please click on the link to our <a href="./privacy.php">Privacy Policy</a>.
                        </p>
                    </div>
                </div>
            </div>
            <h3>Source: <a href="https://www.lazada.vn/helpcenter/?spm=a2o4n.13061297.footer_top.2.545c332ft4cRqZ">Lazada</a></h3>
        </div>
    </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
<script src="header.js"></script>

</body>

</html>