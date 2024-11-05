<?php
    // session_start();
    if (isset($_SESSION['logged_user'])) {
        
        if ($_SESSION['logged_user']['role'] == 'customer') {
        echo "
        <div id='nav_header' class='desktop'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='customer_page.php' class='nav_link'>Customer page</a>
                </li>
            </ul>

            <ul class=nav_navbar>
                <li class=nav_item>
                    <a href='my_account.php' class='nav_btn' id='acc_btn'>My account</a>
                </li>
                <li class=nav_item>
                    <a href='logout_handler.php' class='nav_btn' id='logout_btn' >Logout</a>
                </li>
            </ul>
        </div>
        <div id='nav_header' class='menu_btn'>
            <button class='nav_btn' id='open'>Menu</button>
        </div>
        <div id='nav_header' class='mobile'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='customer_page.php' class='nav_link'>Customer page</a>
                </li>
            </ul> ";
        }

        if ($_SESSION['logged_user']['role'] == 'vendor') {
            echo "
        <div id='nav_header' class='desktop'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='vendorpage.php' class='nav_link'>Vendor page</a>
                </li>
            </ul>

            <ul class=nav_navbar>
                <li class=nav_item>
                    <a href='my_account.php' class='nav_btn' id='acc_btn'>My account</a>
                </li>
                <li class=nav_item>
                    <a href='logout_handler.php' class='nav_btn' id='logout_btn' >Logout</a>
                </li>
            </ul>
        </div>
        <div id='nav_header' class='menu_btn'>
            <button class='nav_btn' id='open'>Menu</button>
        </div>
        <div id='nav_header' class='mobile'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='vendorpage.php' class='nav_link'>Vendor page</a>
                </li>
            </ul> ";
        }
        
        if ($_SESSION['logged_user']['role'] == 'shipper') {
            echo "
        <div id='nav_header' class='desktop'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='shipper_page.php' class='nav_link'>Shipper page</a>
                </li>
            </ul>

            <ul class=nav_navbar>
                <li class=nav_item>
                    <a href='my_account.php' class='nav_btn' id='acc_btn'>My account</a>
                </li>
                <li class=nav_item>
                    <a href='logout_handler.php' class='nav_btn' id='logout_btn' >Logout</a>
                </li>
            </ul>
        </div>
        <div id='nav_header' class='menu_btn'>
            <button class='nav_btn' id='open'>Menu</button>
        </div>
        <div id='nav_header' class='mobile'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class ='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
                <li class='nav_item'>
                    <a href='shipper_page.php' class='nav_link'>Shipper page</a>
                </li>
            </ul> ";
        }
        
            echo "
            <ul class=nav_navbar>
                <li class=nav_item>
                    <a href='my_account.php' class='nav_btn' id='acc_btn'>My account</a>
                </li>
                <li class=nav_item>
                    <a href='logout_handler.php' class='nav_btn' id='logout_btn' >Logout</a>
                </li>
                <li class='nav_item'>
                    <button id='close' class='nav_btn'>Close</button>
                </li>
            </ul>
        </div>
        ";
    }

    else {
        echo "
        <div id='nav_header' class='desktop'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
            </ul>

            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='login.php' class='nav_btn' id='login_btn'>Login</a>
                </li>
                <li class='nav_item'>
                    <a href='registerpage.php' class='nav_btn' id='register_btn'>Register</a>
                </li>
            </ul>
        </div>

        <div id='nav_header' class='menu_btn'>
            <button class='nav_btn' id='open'>Menu</button>
        </div>

        <div id='nav_header' class='mobile'>
            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='/' class='nav_link logo_container'>
                        <img class='logo' src='images\logo.png' alt='logo'>
                    </a>
                </li>
                <li class='nav_item'>
                    <a href='index.php' class='nav_link'>Home</a>
                </li>
            </ul>

            <ul class='nav_navbar'>
                <li class='nav_item'>
                    <a href='login.php' class='nav_btn' id='login_btn'>Login</a>
                </li>
                <li class='nav_item'>
                    <a href='registerpage.php' class='nav_btn' id='register_btn'>Register</a>
                </li>
                <li class='nav_item'>
                    <button id='close' class='nav_btn'>Close</button>
                </li>
            </ul>
        </div>
        ";
    }
?>