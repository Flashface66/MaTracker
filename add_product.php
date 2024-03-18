<?php
   session_start();
       if(!isset($_SESSION['userlogin'])){
           header("Location: login.php");
       }
   
       if(isset($_GET['logout'])){
           session_destroy();
           unset($_SESSION);
           header("Location: login.php");
           
       }
       if($_SESSION['userlogin']['type'] !== "supplier"){
        // isn't admin, redirect them to a different page
        header("Location: index.php");
    }
   ?>
<?php
   require_once('config.php');
   ?>

<?php
    if(isset($_POST['add-product'])){
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_keywords = $_POST['product_keywords'];
        $product_price = $_POST['product_price'];
        $product_unit = $_POST['product_unit'];
        $Sid = $_SESSION['userlogin']['Sid'];
        $fileName = basename($_FILES['product_image']['name']);
        $targetDir = "images/";
        $targetFilePath = $targetDir . $fileName;


        //Checking if any of the fields is empty
       
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath);

            //Insert items into database
            $sql = "INSERT INTO Products(Sid, product_title, product_description, product_keywords, product_image, product_price, product_unit) VALUES(?,?,?,?,?,?,?)";
           $stmtinsert = $db->prepare($sql);
           $result = $stmtinsert->execute([$Sid, $product_name, $product_description, $product_keywords, $fileName, $product_price, $product_unit]);
            if($result) {
                echo "<script> alert('Product added successfully') </script>";
            }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add an Item</title>
    <link rel="stylesheet" href="add_product.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-primary">
         <img src="logo.png" alt="" class="logo">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
               </li>
               <?php
                     if($_SESSION['userlogin']['type'] == "supplier"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='add_product.php'>Add Products</a>
                        </li>";
                     }
                  ?>

                  <?php
                   if($_SESSION['userlogin']['type'] == "supplier"){
                     echo "<li class='nav-item'>
                     <a class='nav-link' href='display_product.php'>My Products</a>
                     </li>";
                 }
                  
                  ?>


                  <?php
                     if($_SESSION['userlogin']['type'] == "supplier"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='delete_product.php'>Delete Product</a>
                        </li>";
                     } 
                  ?>

                 <?php
                     if($_SESSION['userlogin']['type'] == "supplier"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='edit_product.php'>Edit Product</a>
                        </li>";
                     } 
                  ?>
               <li class="nav-item">
                  <a class="nav-link" href="index.php?logout=true">Logout</a>
               </li>
            </ul>
         </div>
      </nav>
    <div class="container">
        <h1>Add a Product</h1>
        <!-- form -->
        <div class="form">
        <form action="add_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" placeholder="e.g., Concrete"
            autocomplete="off" required= "required">
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" name="product_description" id="product_description" placeholder="Enter product description"
            autocomplete="off" required="required">
        </div>

        <!-- Keywords -->
        <div class="form-group">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" placeholder="Enter product keywords"
            autocomplete="off" required="required">
        </div>

        <!-- Image -->
        <div class="form-group">
            <label for="product_image" class="form-label">Product Image</label>
            <input type="file" name="product_image" id="product_image" required="required">
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="product_price" class="form-label">Price</label>
            <input type="text" name="product_price" id="product_price" placeholder="Enter product price"
            autocomplete="off" required="required">
        </div>

        <!-- Unit -->
        <div class="form-group">
            <label for="product_unit" class="form-label">Unit</label>
            <input type="text" name="product_unit" id="product_unit" placeholder="Enter product unit"
            autocomplete="off" required="required">
        </div>

        <!-- Insert Product Button -->
        <div class="form-group">
            <input type="submit" name="add-product" class="btn-primary" value="Add Product" id="add_product">
        </div>
        </form>
        </div>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>