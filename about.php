<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="about.css">
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content" id="about_page">
        <div class="container">
            <div id="group_infor">
                <div class="form_container">
                    <div class="form_title">
                        <h1>GROUP 32</h1>
                    </div>
                </div>
            </div>
            <div id="group_member">
                <div class="form_container" id="kiet">
                    <div class="form_title">
                        <div class="form_item_profile">
                            <img src="images\avatar.png" alt="Avatar">
                        </div>
                    </div>
                    <div class="form_body">
                        <div class="form_item">
                            <h2>Kiet Duong</h2>
                        </div>
                        <div class="form_item">
                            <h4>Front-end Developer</h4>
                            <p>Kiet is a web programmer who specializes in front-end development. He possesses solid skills in CSS, JavaScript, and ReactJs. In addition, with experience working on different projects, he also acquires useful professional skills in project management.</p>
                        </div>
                    </div>
                </div>

                <div class="form_container" id="hung">
                    <div class="form_title">
                        <div class="form_item_profile">
                            <img src="images\avatar.png" alt="Avatar">
                        </div>
                    </div>
                    <div class="form_body">
                        <div class="form_item">
                            <h2>Hung Nguyen</h2>
                        </div>
                        <div class="form_item">
                            <h4>Front-end developer</h4>
                            <p>Hung is a front-end developer with more than 2 years of experience in web development. He has strong knowledge and programming skills in JavaScript. Besides, Hung has expertise in interface design and is a UX/UI designer.</p>
                        </div>
                    </div>
                </div>

                <div class="form_container" id="khoa">
                    <div class="form_title">
                        <div class="form_item_profile">
                            <img src="images\avatar.png" alt="Avatar">
                        </div>
                    </div>
                    <div class="form_body">
                        <div class="form_item">
                            <h2>Anh Khoa</h2>
                        </div>
                        <div class="form_item">
                            <h4>Back-end Developer</h4>
                            <p>Khoa has outstanding knowledge of back-end programming. He specializes in programming languages like Python, PHP, and SQL. He is also a project manager with many good soft skills and teamwork.</p>
                        </div>
                    </div>
                </div>

                <div class="form_container" id="khang">
                    <div class="form_title">
                        <div class="form_item_profile">
                            <img src="images\avatar.png" alt="Avatar">
                        </div>
                    </div>
                    <div class="form_body">
                        <div class="form_item">
                            <h2>Khang Lam</h2>
                        </div>
                        <div class="form_item">
                            <h4>Full-stack developer</h4>
                            <p>Lam has significant amount of experience working on different projects and has a wide knowledge of both front-end and back-end. With good programming skills in JavaScript and PHP, he is a full-stack developer as well as a tester in the team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
    <script src="about.js"></script>
    <script src="header.js"></script>
</body>

</html>