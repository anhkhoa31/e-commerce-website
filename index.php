<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="'UTF-8">
    <meta http-eqiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta name="author" content="Group 32">
    <meta name="description" content="This is a website used to buy stuff and goods.">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <title>Homepage</title>
</head>

<body>
    <?php
        require_once("header.php");
    ?>

    <section class="homepage main_content" id="home">
        <div class="image">
            <img src="images/lazadasale2.png" alt="Sale">
        </div>
        <div class="introduction">
            <h2><span>Wide range of products</span></h2>
            <h3>Easy to operate</h3>
            <a href="login.php" class="begin">Log in for shopping now</a>
        </div>
    </section>
    <!-- <footer>
        <section class="endpage">
            <div class="wrapper">
                <div class="box">
                    <a href="#" id="lazada_logo">
                        <img src="images\lazadalogo.png" alt="Lazada">
                    </a>
                    <p>
                        Lazada is Asia’s leading online department store offering a fast, secure and convenient online shopping experience with a broad product offering in categories ranging from fashion, consumer electronics to household goods, toys and sports equipment. 
                    </p>
                    <div class="follow_us">
                        <a href="https://www.facebook.com/LazadaVietnam" class="btn fab fa-facebook-f"></a>
                        <a href="https://www.linkedin.com/company/lazada" class="btn fab fa-linkedin"></a>
                        <a href="https://www.youtube.com/user/LazadaVN" class="btn fab fa-youtube"></a>
                        <a href="https://www.pinterest.com/lazadavn/" class="btn fab fa-pinterest"></a>
                    </div>
                </div>
                <div class="box">
                    <h3>Lazada Southeast Asia</h3>
                    <div class="quickinformation">
                        <a href="#">Singapore</a>
                        <a href="#">Malaysia</a>
                        <a href="#">Philipines</a>
                        <a href="#">Indonesia</a>
                        <a href="#">Thailand</a>
                        <a href="#">Vietnam</a>
                    </div>
                </div>
                <div class="box">
                    <h3>Delivery Services</h3>
                    <div class="quickinformation">
                        <a href="#">Ninja Van</a>
                        <a href="#">Ahamove</a>
                        <a href="#">Lazada Logistic</a>
                        <a href="#">GHN Express</a>
                        <a href="#">Best Express</a>
                    </div>
                </div>
                <div class="box">
                    <h3>About us</h3>
                    <div class="quickinformation">
                    
                    </div>
                </div>
            </div>
            <h1 class="copyright">Copyright by <span>Group 32</span>. All Rights Reserved.</h1>
        </section>
    </footer> -->
    <?php
        require_once("footer.php");
    ?>
<script src="script.js"></script>
<script src="header.js"></script>

</body>
    
</html>
