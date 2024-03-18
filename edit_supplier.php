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
       if($_SESSION['userlogin']['type'] !== "Admin"){
        // isn't admin, redirect them to a different page
        header("Location: index.php");
    }
   ?>
<?php
   require_once('config.php');
   ?>
<?php
    if(isset($_POST['edit-supplier'])){
        $supplier_name = $_POST['supplier_name'];
        $supplier_email = $_POST['supplier_email'];
        $supplier_phone1 = $_POST['supplier_phone1'];
        $supplier_description = $_POST['supplier_description'];
        $supplier_phone2 = $_POST['supplier_phone2'];
        $supplier_address1 = $_POST['supplier_address1'];
        $supplier_address2 = $_POST['supplier_address2'];
        $supplier_address3 = $_POST['supplier_address3'];


            //Insert edited supplier information into database
           $sql = "UPDATE Suppliers SET SupplierName=?, SupplierEmail=?, Address1=?, Address2=?, Address3=?, SupplierDescription=?, SupplierNum1=?, SupplierNum2=? WHERE SupplierName=?";
           $stmtinsert = $db->prepare($sql);
           $result = $stmtinsert->execute([$supplier_name, $supplier_email, $supplier_address1, $supplier_address2, $supplier_address3, $supplier_description, $supplier_phone1, $supplier_phone2, $supplier_name]);
            if($result) {
                echo "<script> alert('Supplier Updated') </script>";
            }else{
                echo "<script> alert('Error Encountered') </script>";
            }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier Information</title>
    <link rel="stylesheet" href="edit_supplier.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="add_product.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
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
            <form class="form-inline my-2 my-lg-0" action="search_product.php" method="post">
               <input type="search" name="search_data" required class="form-control mr-sm-2" type="search" placeholder="Search for material" aria-label="Search for material">
               <button class="btn btn-light my-2 my-sm-0" type="submit" name="search_data_product">Search</button>
            </form>
         </div>
      </nav>

    <div class = "container">
    <h1>Edit a Supplier</h1>
        <br>
        
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline">
            <h5>Please re-enter the name of the supplier that you want to edit:</h5>    
            <label for="supplier_name" class="form-label">Name of Supplier</label>
            <input type="text" name="supplier_name" id="supplier_name" placeholder="Enter Supplier Name"
            autocomplete="off" required= "required">
    </div>

    <!-- Email -->
    <div class="form-outline">
        <h5>Please enter the changes that you wish to make to the supplier:</h5>
        <label for="supplier_email" class="form-label">Email</label>
        <input type="text" name="supplier_email" id="supplier_email" placeholder="Enter Supplier Email"
        autocomplete="off" required="required">
    </div>

    <!-- Telephone1 -->
    <div class="form-outline">
        <label for="supplier_phone1" class="form-label">Primary Number</label>
        <input type="tel" name="supplier_phone1" id="supplier_phone1" placeholder="Enter supplier primary phone number"
        autocomplete="off" required="required">
    </div>

    <!-- Telephone2 -->
    <div class="form-outline">
        <label for="supplier_phone2" class="form-label">Secondary Number</label>
        <input type="tel" name="supplier_phone2" id="supplier_phone2" placeholder="Enter supplier secondary phone number"
        autocomplete="off" required="required">
    </div>

    <!-- Address1 -->
    <div class="form-outline">
        <label for="supplier_address" class="form-label">Address1</label>
        <input type="text" name="supplier_address1" id="supplier_address1" placeholder="Enter supplier address1"
        autocomplete="off" required="required">
    </div>

    <!-- Address2 -->
    <div class="form-outline">
        <label for="supplier_address" class="form-label">Address2</label>
        <input type="text" name="supplier_address2" id="supplier_address3" placeholder="Enter supplier address2"
        autocomplete="off" required="required">
    </div>

    <!-- Address3 -->
    <div class="form-outline">
        <label for="supplier_address" class="form-label">Address3</label>
        <input type="text" name="supplier_address3" id="supplier_address3" placeholder="Enter supplier address3"
        autocomplete="off" required="required">
    </div>

     <!-- Supplier Description -->
     <div class="form-outline">
        <label for="supplier_description" class="form-label">Supplier Description</label>
        <input type="text" name="supplier_description" id="supplier_description" placeholder="Enter supplier description"
        autocomplete="off" required="required">
    </div>
    <br>
    <!-- Edit Supplier Button -->
    <div class="form-outline">
        <input type="submit" name="edit-supplier" class="btn-primary" value="Edit Supplier">
    </div>
    </form>
    </div>
    <?php include('footer.php');  ?>
</body>
</html>