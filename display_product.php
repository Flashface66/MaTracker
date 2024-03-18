<?php
   require_once('config.php');
   session_start();
   if(!isset($_SESSION['userlogin'])){
       header("Location: login.php");
       exit(); // Make sure no further code is executed after redirection
   }

   if(isset($_GET['logout'])){
       session_destroy();
       unset($_SESSION);
       header("Location: login.php");
       exit();
   }

   require_once('common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaTracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navigation Bar here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
         <img src="logo.png" alt="" class="logo">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
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
            <form class="form-inline my-2 my-lg-0" action="search_product.php" method="post">
               <input type="search" name="search_data" required class="form-control mr-sm-2" type="search" placeholder="Search for material" aria-label="Search for material">
               <button class="btn btn-light my-2 my-sm-0" type="submit" name="search_data_product">Search</button>
            </form>
         </div>
      </nav>

    <div class="container">
        <div class="row justify-content-center">
            <h1>Supplier Products<br><br><br></h1>
        </div>
        <div class="row">
            <!-- Fetching and Displaying Products -->
            <?php
               // Example: Fetch products for supplier with ID 1
               // You should modify this part to get the actual $Sid from request or session
               $Sid = isset($_SESSION['userlogin']['Sid']) ? $_SESSION['userlogin']['Sid'] : '';
               if($Sid != '') {
                   $resultFetched = display_Sproducts($Sid);
                   
                   if ($resultFetched == 0){
                       echo "<div class='row justify-content-center'>
                           <h3>No Products Found</h3>
                       </div>";
                   }
               } else {
                   echo "<div class='row justify-content-center'>
                       <h3>Supplier ID is not specified.</h3>
                   </div>";
               }
            ?>
        </div>
    </div>


    <?php include('footer.php'); ?>
</body>
</html>
