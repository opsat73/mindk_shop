SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `mindk_shop`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`products` (
  `product_id` INT NOT NULL,
  `product_name` VARCHAR(255) NULL DEFAULT 'null',
  `product_count` FLOAT NOT NULL DEFAULT 0,
  `product_description` TEXT NULL DEFAULT 'null',
  `product_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `product_available` TINYINT NOT NULL DEFAULT 0,
  `product_visible` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB
COMMENT = 'table for product, description and count in the store';


-- -----------------------------------------------------
-- Table `mindk_shop`.`pictures`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`pictures` (
  `picture_id` INT NOT NULL,
  `picture_product_id` INT NULL,
  `picture_file_type` ENUM('T','S') NULL,
  `picture_file_name` VARCHAR(45) NULL,
  `picture_origin_file_name` VARCHAR(45) NULL,
  PRIMARY KEY (`picture_id`),
  CONSTRAINT `fk_table1_1`
    FOREIGN KEY (`picture_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'table for storing pictures for products';

CREATE INDEX `fk_table1_1_idx` ON `mindk_shop`.`pictures` (`picture_product_id` ASC);


-- -----------------------------------------------------
-- Table `mindk_shop`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`categories` (
  `category_id` INT NOT NULL,
  `category_name` VARCHAR(255) NULL,
  `category_order` INT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB
COMMENT = 'store categories of products';


-- -----------------------------------------------------
-- Table `mindk_shop`.`category2products_map`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`category2products_map` (
  `cat2prod_map_id` INT NOT NULL,
  `cat2prod_map_product_id` INT NULL,
  `cat2prod_map_category_id` INT NULL,
  PRIMARY KEY (`cat2prod_map_id`),
  CONSTRAINT `fk_category2products_map_1`
    FOREIGN KEY (`cat2prod_map_category_id`)
    REFERENCES `mindk_shop`.`categories` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category2products_map_2`
    FOREIGN KEY (`cat2prod_map_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_category2products_map_1_idx` ON `mindk_shop`.`category2products_map` (`cat2prod_map_category_id` ASC);

CREATE INDEX `fk_category2products_map_2_idx` ON `mindk_shop`.`category2products_map` (`cat2prod_map_product_id` ASC);


-- -----------------------------------------------------
-- Table `mindk_shop`.`bucket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`bucket` (
  `bucket_id` INT NOT NULL,
  `bucket_product_id` INT NULL,
  `bucket_product_count` INT NULL,
  `bucket_order_id` INT NULL,
  PRIMARY KEY (`bucket_id`),
  CONSTRAINT `fk_bucket_1`
    FOREIGN KEY (`bucket_product_id`)
    REFERENCES `mindk_shop`.`products` (`product_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_bucket_1_idx` ON `mindk_shop`.`bucket` (`bucket_product_id` ASC);


-- -----------------------------------------------------
-- Table `mindk_shop`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mindk_shop`.`orders` (
  `order_id` INT NOT NULL,
  `order_bucket_id` INT NULL,
  `order_description` INT NULL,
  `order_session` INT NULL,
  `order_consumer_first_name` VARCHAR(45) NULL,
  `order_consumer_last_name` VARCHAR(45) NULL,
  `order_consumer_phone` VARCHAR(45) NULL,
  `order_consumer_email` VARCHAR(45) NULL,
  `order_UID` VARCHAR(45) NULL,
  PRIMARY KEY (`order_id`),
  CONSTRAINT `fk_orders_1`
    FOREIGN KEY (`order_bucket_id`)
    REFERENCES `mindk_shop`.`bucket` (`bucket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_orders_1_idx` ON `mindk_shop`.`orders` (`order_bucket_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
