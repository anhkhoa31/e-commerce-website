<?php
    session_start();
    function read_from_file() {
        $file_name = 'products.csv';
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
    }

        if ($_GET['choice'] == 'load') {
            read_from_file();
        }

        
?>        

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="registrationpage.css">
    <link rel="stylesheet" href="./app.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <title>Lazada</title>
    </head>
    <body>
        <?php
        require_once("header.php");
        ?>
        <div class="main_content">
            <h1>My Products</h1>
            <?php
                if (isset($_SESSION['products'])) {
                    echo '<table>';
                    echo '<tr><th>ID</th><th>Image</th><th>Name</th><th>Price</th><th>Description</th><th>Date Created</th></tr>';
                    foreach($_SESSION['products'] as $index => $product){
                        $i=++$index;
                        if($product['vendor'] == $_SESSION['logged_user']['username']){
                            echo "<tr><td>$i</td><td><img src='$product[image]'></td><td>$product[name]</td><td>$product[price]</td><td>$product[description]</td><td>$product[created_time]</td></tr>";
                        }
                    }
                    echo '</table>';
                }
            ?>
        </div>
        <?php
        require_once("footer.php");
        ?>

    </body> 
</html>
