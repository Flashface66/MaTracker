<?php
   $db_host = "127.0.0.1:3306";
   $database   = 'mysql';
   $db_user = "root";
   $db_pass = "";
   $db_name = "LavonneS_Associates";

   
   try {
      // 
   
   $db = new PDO($database . ":host=" . $db_host . ';dbname=' . $db_name, $db_user, $db_pass);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


   //  // Prepare SQL query to insert admin account
   //  $sql = "INSERT INTO Admins (AdminName, AdminEmail, AdminPassword, type) VALUES (?, ?, ?, ?)";

   //  // Use password_hash() to securely hash the password
   //  $hashedPassword = password_hash('pass1234', PASSWORD_DEFAULT);

   //  // Prepare statement
   //  $stmt = $db->prepare($sql);

   //  // Bind parameters and execute statement
   //  // Replace the placeholders with your actual admin details
   //  $stmt->execute(['Roger', 'admin@example.com', $hashedPassword, 'Admin']);

   //  echo "Admin account created successfully.";

} catch(PDOException $e) {
    die("Error creating admin account: " . $e->getMessage());
}
?>

