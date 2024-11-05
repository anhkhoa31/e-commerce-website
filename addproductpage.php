<?php include 'addproduct.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="registrationpage.css">
  <link rel="stylesheet" href="./app.css">
  <link rel="stylesheet" href="./header.css">
  <link rel="stylesheet" href="./footer.css">
  <title>Add product</title>
</head>

<body>
  <?php
  require_once("header.php");
  ?>
  <div class='main_content'>
    <h1 class="form-title">Add New Product</h1>
    <form method="post" action="addproduct.php" enctype="multipart/form-data" id="addproduct-form" name="addproduct-form">
      <div class="form-body">
        <div class="form-field">
          <label for="productname">Product name:</label>
          <input class="form_item" id="productname" type="text" placeholder="Enter your product name" name="productname" required minlength="10" maxlength="20">
          <span class="form_item" id="productname-error"></span>
        </div>
        <div class="form-field">
          <label for="productprice">Product price:</label>
          <input class="form_item" type="number" min="0" placeholder="Enter product price" name="productprice" required id="productprice">
        </div>
        <div class="form-field">
          <label for="productimage">Choose your profile picture:</label>
          <input class="form_item" required id="productimage" type="file" name="file">
        </div>
        <div class="form-field">
          <label for="description" class="description">Product description:</label>
          <div>
            <textarea class="form_item" cols="65" rows="10" id="description" name="description" required maxlength="500"></textarea>
          </div>
        </div>
        <div class="form-field">
          <input class="btn" type="submit" id="button" name="addproduct" value="Add">
        </div>
      </div>
    </form>
  </div>
  <?php
  require_once("footer.php");
  ?>
  <script src="registrationpage.js"></script>

</body>

</html>