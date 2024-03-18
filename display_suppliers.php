<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header("Location: login.php");
    exit();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="search_product.css"> -->
    <link rel="stylesheet" href="styles.css">
    
    
    <title>View Suppliers</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <!-- Navbar content similar to what you provided -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
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
                     if($_SESSION['userlogin']['type'] == "User" or $_SESSION['userlogin']['type'] == "Admin"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='display_suppliers.php'>View Suppliers</a>
                        </li>";
                     }
                  ?>
                <?php
                     if($_SESSION['userlogin']['type'] == "Admin"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='add_supplier.php'>Add Suppliers</a>
                        </li>";
                     }
                  ?>
                                
                  <?php
                     if($_SESSION['userlogin']['type'] == "Admin"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='delete_supplier.php'>Delete Supplier</a>
                        </li>";
                     }
                  ?>
                                    
                  <?php
                     if($_SESSION['userlogin']['type'] == "Admin"){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='edit_supplier.php'>Edit Suppliers</a>
                        </li>";
                     }
                  ?>
               
               <li class="nav-item">
                  <a class="nav-link" href="index.php?logout=true">Logout</a>
               </li>
            </ul>
         </div>
      </nav>
    </nav>
    <div class="container">
        <h1 class="mt-5">Suppliers List</h1>
        <div class="row">
            <?php
            // Call to your function that displays all suppliers
            display_suppliers();
            ?>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
