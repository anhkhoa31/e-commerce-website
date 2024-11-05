<?php
session_start();
if (!isset($_SESSION['logged_user']) || $_SESSION['logged_user']['role'] != "customer") {
header('location: my_account.php');
}
$product_file = "products.csv";
$product_list = [];

function filter($min, $max)
{
    if ($min == null) {
        $min = 0;
    }

    $file_name = "products.csv";
    $fp = fopen($file_name, 'r');
    // first row => field names
    $keys = fgetcsv($fp);
    $products = [];
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $product = [];
        foreach ($keys as $key) {
            $product[$key] =  $row[$i];
            $i++;
        }
        if ($max == null) {
            if ($product['price'] >= $min) {
                $products[] = $product;
            }
        } else {
            if ($product['price'] <= $max && $product['price'] >= $min) {
                $products[] = $product;
            }
        }
    }
    return $products;
}

function search($name)
{
    $pattern = "/" . $name . "/i";
    $file_name = "products.csv";
    $fp = fopen($file_name, 'r');
    // first row => field names
    $keys = fgetcsv($fp);
    $products = [];
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $product = [];
        foreach ($keys as $key) {
            $product[$key] =  $row[$i];
            $i++;
        }
        if (preg_match($pattern, $product['name'])) {
            $products[] = $product;
        }
    }
    return $products;
}

function render_product($product)
{
    if ($product == null) {
        echo "<div>None</div>";
    } else {
        $id = $product['id'];
        $vendor = $product['vendor'];
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        $created_time = $product['created_time'];
        $img = $product['image'];
        echo "
        <div class='$id column d-flex justify-content-center align-items-center'>
            <div class='card p-3 d-flex justify-content-center align-items-center'>
                <div>
                <img src='$img' width='200' height='200'>
                </div>
                <div class='flex-fill w-75'>
                    <span>Vendor: </span>
                    <span class='vendor'>$vendor</span>
                    <br/>
                    <span>Name: </span>
                    <span class='name'>$name</span>
                    <br/>
                    <span>Price: </span>
                    <span class='price'>$price</span>
                    <br/>
                    <span>Description: </span>
                    <span class='description'>$description</span>
                    <br/>
                    <span>Created time: </span>
                    <span class='created_time'>$created_time</span>
                </div>
                <div>
                    <button class='nav_btn' onClick='reply_click(this)' data-id='$id' id='add'>Add to cart</button>
                </div>
            </div>
        </div>
        ";
    }
}


// Search for name
if (isset($_POST['search'])) {
    $search_name = $_POST['search_name'];
    $product_list = search($search_name);
    $_SESSION['result'] = $product_list;
}

// Filter for price
if (isset($_POST['filter'])) {
    $min = $_POST['min'];
    $max = $_POST['max'];
    $product_list = filter($min, $max);
    $_SESSION['result'] = $product_list;
}

if (isset($_POST['confirm_order'])) {
    $order_id = "o" . uniqid();
    $status = "active";
    $total_price = 0;
    $order_arr = json_decode(($_POST['order_value']));
    foreach ($order_arr as $product) {
        $price = $product->p_price;
        $quantity = $product->p_quantity;
        $total_price += $price * $quantity;
        $products[]= [$product->p_id,$product->p_quantity];
    }
    // print_r(gettype($order_arr[0]->p_price));
    // print_r($total_price);
    // print_r($products);
    $order = array($order_id, $status, json_encode($products), $total_price, $_SESSION['logged_user']['address']);
    $file = ['Ibotta.csv', 'Party Plex.csv', 'Darwin.csv'];
    $i = rand(0,2);
    $path = fopen($file[$i], "a");
    fputcsv($path, $order);
    fclose($path);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="customer_page.css">
    <title>Customer page</title>
</head>

<body>
    <?php
    require_once("header.php");
    ?>

    <div class="main_content" id="customer_page">
        <div id="search_bar" class="">
            <form action="customer_page.php" method="post" class="search">
                <div class="form_item_group">
                    <input class="form_item" type="text" name="search_name" id="search" placeholder="Product name">
                    <input class="btn form_item" type="submit" name="search" value="Search" class="btn">
                </div>
            </form>
            <form action="customer_page.php" method="post" class="filter">
                <div class="form_item_group">
                    <input type="number" name="min" id="min" min="0" class="form_item" placeholder="Min">
                </div>
                <div class="form_item_group">
                    <input type="number" name="max" id="max" min="0" class="form_item" placeholder="Max">
                </div>
                <div class="form_item_group">
                    <input type="submit" name="filter" value="Filter" class="btn">
                </div>
            </form>
            <div class="shopping_cart_icon">
                <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Cart</button>
            </div>
        </div>

        <div id='products' class="">
            <div class="w-100">
                <div id="product_container">
                    <?php
                    if (isset($_SESSION['result'])) {
                        if ($_SESSION['result'] == null) {
                            render_product($_SESSION['result']);
                        } else {
                            foreach ($_SESSION['result'] as $product) {
                                render_product($product);
                            }
                        }
                    } else {
                        // Show all available products
                        $product_list = search('');
                        foreach ($product_list as $product) {
                            render_product($product);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Shopping cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div id="shopping_cart">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created time</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="cart_body">

                        </tbody>
                    </table>
                    <form action="customer_page.php" method="post">
                        <button type="button" class="btn btn-danger" onClick="reset_cart()">Remove all</button>
                        <input name="order_value" id="order_value" class="d-none">
                        <input type="submit" value="Confirm order" class="btn btn-success" name="confirm_order" onClick="order()"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
    <script src="customer_page.js"></script>
    <script src="header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>