CREATE DATABASE IF NOT EXISTS `LavonneS_Associates`;
USE `LavonneS_Associates`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Suppliers` (
    `Sid` INT AUTO_INCREMENT PRIMARY KEY,
    `SupplierName` VARCHAR(255) NOT NULL,
    `supplierEmail` VARCHAR(255) NOT NULL UNIQUE,
    `SupplierDescription` TEXT NOT NULL,
    `SupplierNum1` VARCHAR(20),
    `SupplierNum2` VARCHAR(20) NOT NULL,
    `Address1` VARCHAR(255),
    `Address2` VARCHAR(255),
    `Address3` VARCHAR(255),
    `SupplierPassword` VARCHAR(255),
    `type` ENUM('supplier') NOT NULL DEFAULT 'supplier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_title` VARCHAR(255) NOT NULL,
    `product_description` TEXT NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    `product_unit` VARCHAR(100),
    `product_image` VARCHAR(255),
    `Sid` INT,
    `product_keywords` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`Sid`) REFERENCES `Suppliers`(`Sid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Users` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `phonenumber` VARCHAR(20),
    `companyname` VARCHAR(255),
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `admins` (
  `Aid` INT AUTO_INCREMENT PRIMARY KEY,
  `AdminName` VARCHAR(255) NOT NULL,
  `AdminEmail` VARCHAR(255) NOT NULL UNIQUE,
  `AdminPassword` VARCHAR(255) NOT NULL,
  `type` ENUM('Admin') NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion of initial data for `admins`
INSERT INTO `admins` (`Aid`, `AdminName`, `AdminEmail`, `AdminPassword`, `type`) VALUES
(1, 'Roger', 'admin@example.com', '$2y$10$ReL6LE4vqnwjCMlDMRsfEeMInnK5658sGoQZMjiUDb6rLBUEgQZ.a', 'Admin');

-- -- Insertion of initial data for `suppliers`
-- INSERT INTO `suppliers` (`Sid`, `SupplierName`, `supplierEmail`, `SupplierDescription`, `SupplierNum1`, `SupplierNum2`, `Address1`, `Address2`, `Address3`, `SupplierPassword`, `type`) VALUES
-- (1, 'Ryan Willis', 'lumber@test.com', 'Lumber', '876-555-5555', '876-555-5555', 'Road', 'Capital', 'Parish', '$2y$10$veKLOpsr7eSXW9ai09DbCuVRGQU1Vd/lrchcBGqwzo6UYX6Z1p.k6', 'supplier'),
-- (3, 'Chris Evans', 'sand@test.com', 'Sand', '876-555-5555', '876-555-5555', 'Home', 'Home rd', 'Home town', '$2y$10$zc7iW4XWabHEwqy.7BPVUeVhTwvRrRO3eLb.EBnAwfhfp48JZ3BHG', 'supplier');

-- -- Insertion of initial data for `products`
-- INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_price`, `product_unit`, `product_image`, `Sid`, `product_keywords`) VALUES
-- (1, 'Cement', 'Global Concrete', 1400.00, 'kg', '12.png', 1, 'Stone');

-- -- Insertion of initial data for `users`
-- INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `phonenumber`, `companyname`, `email`, `password`, `type`) VALUES
-- (7, 'Yohance', 'Cockett', '876-845-8142', 'Wilkins Industries', 'admin@project.com', '$2y$10$rQQev2jvle8gk5Rlajhepesa/nQKYP4gS3UXZhJZai9jvRlBAyQjS', 'user');

COMMIT;
