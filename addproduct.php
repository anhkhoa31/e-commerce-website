<?php
session_start();
$fileDestination;
if(isset($_POST['addproduct'])){ //save the uploaded image
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; //the upload part is named 'name'
    $fileTmpName = $_FILES['file']['tmp_name']; //temporary file
    $fileSize = $_FILES['file']['size']; //check the size
    $fileError = $_FILES['file']['error']; //popup error 
    $fileType = $_FILES['file']['type']; 

    $fileExt = explode('.', $fileName); //get the extension of the uploaded file
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf'); //only allow those types of image
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'loads/'.$fileNameNew; //save the image to loads folder
                move_uploaded_file($fileTmpName, $fileDestination);
                // header("Location: index.php?uploadsuccess");
            } else {
                echo "Your file is too big";
            }
        } else {
            echo "There is an error while uploading the file, please try again";
        }
    } else {
        echo "This is not valid file";
        }
}

if (isset($_POST['addproduct'])) {
  // $id = "v" . uniqid();
  $product = [
    'vendor' => $_SESSION['logged_user']['username'],
    'name' => $_POST['productname'],
    'price' => $_POST['productprice'],
    'description' => $_POST['description'],
    'created_time' => date('m/d/y H:i'),
    'image' => $fileDestination
  ];
  $_SESSION['products'][] = $product;
  
}

?>


<?php
if(isset($_POST['addproduct'])){
    // header('location: vendorpage.php');
    echo "<script>location.href='vendorpage.php'</script>";

}
?>
<?php
$csv_with_tasks = "products.csv";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $resource = fopen($csv_with_tasks, "a"); // mode "a" - we're appending new data to the end of the file
  if(!$resource) { // successfully opened resource is always true
    echo "An error occurred while opening the CSV file!";
    exit();
  }
  if ($fileDestination === null) {
    echo "Null";
  } else {
    print_r($fileDestination);
}

  $task = array(
    "v" . uniqid(),
    $_SESSION['logged_user']['username'],
    $_POST["productname"],
    $_POST["productprice"],
    $_POST["description"],
    date("m/d/y H:i"),
    $fileDestination
  );

  if(fputcsv($resource, $task) === FALSE) { // saving the task into the file failed if fputcsv didn't return true
    echo "An error occurred while saving the new task to the CSV file!";
    exit();
  }

  if(!fclose($resource)) {
    echo "An error occurred while closing the CSV file!<br />";
    echo "Data might not be correctly saved!";
    exit();
  }
}

?>