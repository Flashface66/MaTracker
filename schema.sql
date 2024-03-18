CREATE DATABASE IF NOT EXISTS `LavonneS_Associates`;
USE `LavonneS_Associates`;

CREATE TABLE IF NOT EXISTS `Suppliers` (
    `Sid` INT AUTO_INCREMENT PRIMARY KEY,
    `SupplierName` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_title` VARCHAR(255) NOT NULL,
    `product_description` TEXT NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    `product_unit` VARCHAR(100),
    `product_image` VARCHAR(255),
    `Sid` INT,
    FOREIGN KEY (`Sid`) REFERENCES `Suppliers`(`Sid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Users` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `phonenumber` VARCHAR(20),
    `companyname` VARCHAR(255),
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
