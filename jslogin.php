<?php
   session_start();
   require('config.php');
   if(isset($_POST)){
       $email = $_POST['email'];
       $password = $_POST['password'];
       $sql = "SELECT *, 'User' as type FROM Users WHERE email = ? LIMIT 1";
       $sql2 = "SELECT *, 'Supplier' as type FROM Suppliers WHERE SupplierEmail = ? LIMIT 1";
       $sql3 = "SELECT *, 'Admin' as type FROM Admins WHERE AdminEmail = ? LIMIT 1"; // New query for Admins table
       
       $stmtselect = $db->prepare($sql);
       $stmtselect2 = $db->prepare($sql2);
       $stmtselect3 = $db->prepare($sql3); // Prepare statement for Admins

       $result = $stmtselect->execute([$email]);
       $user = $stmtselect->fetch(PDO::FETCH_ASSOC);

       $result2 = $stmtselect2->execute([$email]);
       $user2 = $stmtselect2->fetch(PDO::FETCH_ASSOC);

       $result3 = $stmtselect3->execute([$email]); // Execute query for Admins
       $user3 = $stmtselect3->fetch(PDO::FETCH_ASSOC);

       // Determine which result is valid and set session variables accordingly
       if($result && $stmtselect->rowCount() > 0 && password_verify($password, $user['password'])){
           $_SESSION['userlogin'] = $user;
           $_SESSION['userlogin']['type'] = 'User'; // Set type as User
           echo "Successful Login as User";
       }
       elseif($result2 && $stmtselect2->rowCount() > 0 && password_verify($password, $user2['SupplierPassword'])){
           $_SESSION['userlogin'] = $user2;
           $_SESSION['userlogin']['type'] = 'supplier'; // Set type as Supplier
           echo "Successful Login as Supplier";
       }
       elseif($result3 && $stmtselect3->rowCount() > 0 && password_verify($password, $user3['AdminPassword'])){
           $_SESSION['userlogin'] = $user3;
           $_SESSION['userlogin']['type'] = 'Admin'; // Set type as Admin
           echo "Successful Login as Admin";
       }
       else{
           echo "Email or Password incorrect. Try again.";
       }
   }
?>
