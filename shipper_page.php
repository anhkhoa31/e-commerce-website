<?php
session_start();
require("data_handler.php");
$file_path = "accounts.db";

if (!isset($_SESSION['logged_user']) || $_SESSION['logged_user']['role'] != "shipper") {
    echo "<script>location.href='my_account.php'</script>";
} else {
    $logged_user = $_SESSION['logged_user'];
    $username = $logged_user['username'];
    $profile_img_path = $logged_user['profile_image'];
    $user_role = $logged_user['role'];
}

function read_from_file()
{   
    //read all orders
    $file_name = $_SESSION['logged_user']['distribution_hub_name'] . ".csv";
    $fp = fopen($file_name, 'r');
    // first row => field names
    $first = fgetcsv($fp);
    $orders = [];
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $order = [];
        foreach ($first as $col_name) {
            $order[$col_name] =  $row[$i];
            if ($col_name == 'products') {
                $order[$col_name] = json_decode($order[$col_name]);
            }
            $i++;
        }
        $orders[] = $order;
    }
    // overwrite the session variable
    $_SESSION['orders'] = $orders;
    fclose($fp);

    // read products
    $file_name = "products.csv";
    $fp = fopen($file_name, 'r');
    // first row => field names
    $first = fgetcsv($fp);
    $products = [];
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $product = [];
        foreach ($first as $col_name) {
            $product[$col_name] =  $row[$i];
            $i++;
        }
        $products[] = $product;
    }
    // overwrite the session variable
    $_SESSION['products'] = $products;
    fclose($fp);
}

function save_to_file()
{
    $file_name = $_SESSION['logged_user']['distribution_hub_name'] . ".csv";
    $fp = fopen($file_name, 'w');
    $fields = ['id', 'status', 'products', 'total_price', 'address'];
    fputcsv($fp, $fields);
    if (is_array($_SESSION['orders'])) {
        foreach ($_SESSION['orders'] as $order) {
            $order['products'] = json_encode($order['products']);
            fputcsv($fp, $order);
        }
    }
}

if (isset($_POST['delivered'])) {
    foreach ($_SESSION['orders'] as $index => &$order) {
        if ($index == $_POST['delivered']) {
            $order['status'] = 'delivered';
        }
    }
    save_to_file();
}
if (isset($_POST['canceled'])) {
    foreach ($_SESSION['orders'] as $index => &$order) {
        if ($index == $_POST['canceled']) {
            $order['status'] = 'canceled';
        }
    }
    save_to_file();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipper page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./app.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <link rel="stylesheet" href="./shipper.css">
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="main_content">
        <div class='content'>
            <h1><?php
                echo "All active orders at " . $logged_user['distribution_hub_name']
                ?></h1>
            <div class="orders">
                <?php
                read_from_file();
                echo '<ul class="order_list">';
                foreach ($_SESSION['orders'] as $index => $order) {
                    if ($order['status'] == 'active') {
                        echo "<a data-toggle='modal' data-target='#Modal$index'><li>Order ID: $order[id]</li></a>";
                        echo "<div class='modal fade' id='Modal$index' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                            <h4 class='modal-title' id='exampleModalLabel'>Order ID: $order[id]</h4>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            <ul class = 'order_info'>
                                <li>Items:</li>
                                <table><tr><th>#</th><th>Image</th><th>Name</th><th>Price</th><th>Description</th><th>Quantity</th></tr>";
                                
                                $i=1;
                                foreach($_SESSION['products'] as $product){
                                    foreach($order['products'] as $item){
                                        if ($item[0] == $product['id']){
                                            echo "<tr>
                                                    <td>$i</td>
                                                    <td><img src='$product[image]' width='100'></td>
                                                    <td>$product[name]</td>
                                                    <td>$product[price]</td>
                                                    <td>$product[description]</td>
                                                    <td>$item[1]</td>
                                                </tr>";
                                            $i++;
                                        }
                                        
                                    }
                                }
        
                                echo"</table>
                                <li>Total price: \$$order[total_price]</li>
                                <li>Address: $order[address]</li>
                            </ul>
                        </div>
                        <div class='modal-footer'>
                            <form class='form' action='shipper_page.php' method='POST' >
                                <button type='submit' class='btn btn-success' name='delivered' value ='$index'>Delivered</button>
                                <button type='submit' class='btn btn-danger' name='canceled' value='$index'>Cancel Order</button>
                                <button type='submit' class='btn btn-primary' data-dismiss='modal'>Close</button>
                            </form>
                        </div>
                        </div>
                        </div>
                        </div>";
                    }
                }
                echo "</ul>";  
                ?>
            </div>

        </div>
    </div>



    <?php
    require_once("footer.php");
    ?>
    <script src="shipper.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>