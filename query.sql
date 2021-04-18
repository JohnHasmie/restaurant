CREATE TABLE `restaurant`.`users` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `firstname` VARCHAR(100) NULL , 
    `lastname` VARCHAR(100) NULL , 
    `email` VARCHAR(200) NOT NULL , 
    `password` VARCHAR(255) NOT NULL , 
    `location` VARCHAR(255) NULL , 
    PRIMARY KEY (`id`), 
    UNIQUE `email` (`email`)
) ENGINE = InnoDB;

CREATE TABLE `products` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `sku` varchar(255) CHARACTER NOT NULL,
  `name` varchar(255) CHARACTER  NOT NULL,
  `slug` varchar(255) CHARACTER NOT NULL,
  `description` text CHARACTER,
  `quantity` int UNSIGNED NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB

CREATE TABLE `restaurant`.`restaurant` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(200) NOT NULL , 
  `address` VARCHAR(255) NOT NULL , 
  `latitude` BIGINT NULL , 
  `longitude` BIGINT NULL , 
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , 
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;