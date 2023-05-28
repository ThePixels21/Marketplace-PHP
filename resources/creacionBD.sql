CREATE DATABASE Market;
USE Market;

CREATE TABLE `Category` (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) NOT NULL,
`details` TEXT NULL,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL);

CREATE TABLE `Maker` (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) NOT NULL,
`details` TEXT NULL,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL);

CREATE TABLE `Product` (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) NOT NULL,
`nup` INT NOT NULL,
`maker_id` INT NOT NULL,
`category_id` INT NOT NULL,
`price` INT NOT NULL,
`details` TEXT NULL,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
FOREIGN KEY (`maker_id`) REFERENCES Maker (`id`),
FOREIGN KEY (`category_id`) REFERENCES Category(`id`));

CREATE TABLE `Company` (
`id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) NOT NULL,
`address` VARCHAR(60) NOT NULL,
`nit` VARCHAR(50) NOT NULL,
`phone` VARCHAR(13) NOT NULL,
`email` VARCHAR(60) NOT NULL);

CREATE TABLE `Document_type` (
`id` TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(2) NOT NULL,
`details` TEXT);

CREATE TABLE `Client` (
`id` BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`name` VARCHAR(50) NOT NULL,
`lastname` VARCHAR(60) NOT NULL,
`address` VARCHAR(60) NOT NULL,
`phone` VARCHAR(13) NOT NULL,
`document` BIGINT NOT NULL,
`document_type` TINYINT NOT NULL,
`email` VARCHAR(60),
FOREIGN KEY (`document_type`) REFERENCES `Document_type` (`id`));

CREATE TABLE `Sale` (
`id` BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`company_id` INT NOT NULL,
`client_id` BIGINT NOT NULL,
`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
FOREIGN KEY (`company_id`) REFERENCES `Company` (`id`),
FOREIGN KEY (`client_id`) REFERENCES `Client` (`id`));

CREATE TABLE `Product_sold` (
`id` BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
`sale_id` BIGINT NOT NULL,
`product_id` INT NOT NULL,
`amount` TINYINT NOT NULL,
FOREIGN KEY (`sale_id`) REFERENCES `Sale` (`id`),
FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`));

INSERT INTO `Maker` VALUES
(1, 'Santiago', 'Fabricante de alto rango', '2022-11-19'),
(2, 'Torito', 'Buen fabricante', '2022-11-19'),
(3, 'Pipe', 'Frabicante de alta calidad', '2022-11-19'),
(4, 'Sebas', 'Fabricante de componentes', '2022-11-19'),
(5, 'Camilo', 'Fabricante', '2022-11-19');

INSERT INTO `Category` VALUES 
(1, 'Gama alta', 'Alta calidad', '2022-11-19'),
(2, 'Gama media-alta', 'Calidad media-alta', '2022-11-19'),
(3, 'Gama media', 'Calidad media', '2022-11-19'),
(4, 'Gama baja', 'Calidad baja', '2022-11-19');

INSERT INTO `Document_type` VALUES 
(1, 'CC', 'Cedula de ciudadanía'),
(2, 'TI', 'Tarjeta de identidad'),
(3, 'CE', 'Cedula de extranjería'),
(4, 'PP', 'Pasaporte');

INSERT INTO `Company` VALUES 
(1, 'Principal Market', 'Plaza Mayor', '6546', '3014616164', 'suc1@gmail.com'),
(2, 'Sucre Market', 'Parque Sucre', '1851', '3106541641', 'suc2@gmail.com'),
(3, 'Bolivar Market', 'Plaza de Bolivar', '7114', '3121661574', 'suc3@gmail.com');

INSERT INTO `Product` VALUES
(1, 'Celular Xiaomi Note 7', 25252, 1, 3, 1250000, 'Producto de buena calidad gama media', '2022-11-21'),
(2, 'Celular Samsung A24', 76464, 2, 2, 1500000, 'Producto de uso cotidiano, buena calidad', '2022-11-21'),
(3, 'Celular Iphone 13 Pro', 94192, 3, 1, 3500000, 'Producto de alta calidad original', '2022-11-21');

INSERT INTO `Client` VALUES
(1, 'Juan', 'Perez', 'Ciudad Dorada', '3014616841', '103461656', 1, 'juan@gmail.com'),
(2, 'Carlos', 'Ruíz', 'La Grecia', '3165461615', '181651616', 2, 'carlos@gmail.com'),
(3, 'María', 'Gonzales', 'El Granada', '3146519411', '14961654', 4, 'maria@gmail.com');

INSERT INTO `Sale` VALUES
(1, 1, 3, '2022-11-21 12:04:52'),
(2, 3, 2, '2022-11-21 14:30:25'),
(3, 2, 1, '2022-11-21 08:15:12');

INSERT INTO `Product_sold` VALUES
(1, 1, 1, 2),
(2, 1, 3, 1),
(3, 2, 2, 3),
(4, 2, 1, 2),
(5, 3, 1, 4),
(6, 3, 2, 1);