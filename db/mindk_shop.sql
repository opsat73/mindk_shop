SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mindk_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mindk_shop` ;

-- -----------------------------------------------------
-- Table `mindk_shop`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`products` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`products` (
  `product_id` INT NOT NULL AUTO_INCREMENT,
  `product_name` VARCHAR(255) NULL,
  `product_count` FLOAT NOT NULL DEFAULT 0,
  `product_description` TEXT NULL,
  `product_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `product_available` TINYINT NOT NULL DEFAULT 0,
  `product_visible` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB
COMMENT = 'table for product, description and count in the store';


-- -----------------------------------------------------
-- Table `mindk_shop`.`pictures`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`pictures` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`pictures` (
  `picture_id` INT NOT NULL AUTO_INCREMENT,
  `picture_product_id` INT NULL,
  `picture_file_type` VARCHAR(45) NULL,
  `picture_file_name` VARCHAR(45) NULL,
  `picture_origin_file_name` VARCHAR(45) NULL,
  PRIMARY KEY (`picture_id`),
  INDEX `fk_table1_1_idx` (`picture_product_id` ASC),
  CONSTRAINT `fk_table1_1`
    FOREIGN KEY (`picture_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'table for storing pictures for products';


-- -----------------------------------------------------
-- Table `mindk_shop`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`categories` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`categories` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) NULL,
  `category_order` INT NULL,
  `parent_id` INT NULL DEFAULT 0,
  PRIMARY KEY (`category_id`),
  INDEX `fk_categories_1_idx` (`parent_id` ASC),
  CONSTRAINT `fk_categories_1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `mindk_shop`.`categories` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'store categories of products';


-- -----------------------------------------------------
-- Table `mindk_shop`.`category2products_map`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`category2products_map` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`category2products_map` (
  `cat2prod_map_id` INT NOT NULL AUTO_INCREMENT,
  `cat2prod_map_product_id` INT NULL,
  `cat2prod_map_category_id` INT NULL,
  PRIMARY KEY (`cat2prod_map_id`),
  INDEX `fk_category2products_map_1_idx` (`cat2prod_map_category_id` ASC),
  INDEX `fk_category2products_map_2_idx` (`cat2prod_map_product_id` ASC),
  CONSTRAINT `fk_category2products_map_1`
    FOREIGN KEY (`cat2prod_map_category_id`)
    REFERENCES `mindk_shop`.`categories` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category2products_map_2`
    FOREIGN KEY (`cat2prod_map_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mindk_shop`.`bucket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`bucket` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`bucket` (
  `bucket_id` INT NOT NULL AUTO_INCREMENT,
  `bucket_product_id` INT NULL,
  `bucket_product_count` INT NULL,
  `bucket_order_id` INT NULL,
  PRIMARY KEY (`bucket_id`),
  INDEX `fk_bucket_1_idx` (`bucket_product_id` ASC),
  CONSTRAINT `fk_bucket_1`
    FOREIGN KEY (`bucket_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mindk_shop`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mindk_shop`.`orders` ;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`orders` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `order_bucket_id` INT NULL,
  `order_description` INT NULL,
  `order_session` VARCHAR(45) NULL,
  `order_consumer_first_name` VARCHAR(45) NULL,
  `order_consumer_last_name` VARCHAR(45) NULL,
  `order_consumer_phone` VARCHAR(45) NULL,
  `order_consumer_email` VARCHAR(45) NULL,
  `order_UID` VARCHAR(45) NULL,
  `order_status` ENUM('D','O','F') NULL DEFAULT 'D' COMMENT 'D - Draft\nO - ordered\nF - finished',
  PRIMARY KEY (`order_id`),
  INDEX `fk_orders_1_idx` (`order_bucket_id` ASC),
  CONSTRAINT `fk_orders_1`
    FOREIGN KEY (`order_bucket_id`)
    REFERENCES `mindk_shop`.`bucket` (`bucket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
