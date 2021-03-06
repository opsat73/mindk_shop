insert into categories  values(1, 'main', -1, null);
insert into categories  values(2, 'for MindKickers', 0, 1);
insert into categories  values(6, 'for human', 1, 1);
insert into categories  values(7, 'for adult', 5, 6);
insert into categories  values(8, 'for men', 6, 7);
insert into categories  values(9, 'for woomen', 7, 7);
insert into categories  values(10, 'for child', 4, 6);
insert into categories  values(3, 'something else', 2, 1);
insert into categories  values(4, 'exclusive', 8, 3);
insert into categories  values(5, 'intresting', 9, 3);

DROP TABLE IF EXISTS `mindk_shop`.`product_rand1`;
DROP TABLE IF EXISTS `mindk_shop`.`product_rand2`;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`product_rand1` (
  `id`   INT         NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mindk_shop`.`product_rand2` (
  `id`   INT         NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

INSERT INTO `mindk_shop`.product_rand1 (name) VALUES ('super');
INSERT INTO `mindk_shop`.product_rand1 (name) VALUES ('mega');
INSERT INTO `mindk_shop`.product_rand1 (name) VALUES ('turbo');

INSERT INTO `mindk_shop`.product_rand2 (name) VALUES ('phone');
INSERT INTO `mindk_shop`.product_rand2 (name) VALUES ('tv');
INSERT INTO `mindk_shop`.product_rand2 (name) VALUES ('device');

DROP PROCEDURE place_products;
DROP PROCEDURE generate_products;
CREATE PROCEDURE generate_products(IN PRODUCTS_COUNT INT)
  BEGIN
    DECLARE PRODUCT_COUNT INT DEFAULT 1;
    DECLARE TOTAL_NAME VARCHAR(100) DEFAULT '';
    DECLARE RANDOM_DIGIT INT DEFAULT 0;
    DECLARE RANDOM_NAME_PART VARCHAR(50) DEFAULT '';
    DECLARE DESCRIPTION VARCHAR(50) DEFAULT '';
    DECLARE COUNT INT DEFAULT '0';
    DECLARE PRICE DECIMAL(10, 2) DEFAULT '0';
    DECLARE ALPHA VARCHAR(26) DEFAULT 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    WHILE PRODUCT_COUNT < PRODUCTS_COUNT DO
      SET RANDOM_DIGIT = MOD(ROUND(RAND() * 1000), 3)+1;
      SELECT name
      INTO RANDOM_NAME_PART
      FROM mindk_shop.product_rand1
      WHERE id = RANDOM_DIGIT;
      SET TOTAL_NAME = CONCAT(RANDOM_NAME_PART, ' ', SUBSTR(ALPHA, MOD(ROUND(RAND() * 1000), 26), 1), '-');

      SET RANDOM_DIGIT = MOD(ROUND(RAND() * 1000), 3)+1;
      SELECT name
      INTO RANDOM_NAME_PART
      FROM mindk_shop.product_rand2
      WHERE id = RANDOM_DIGIT;
      SET TOTAL_NAME = CONCAT(TOTAL_NAME, RANDOM_NAME_PART, ' ', MOD(ROUND(RAND() * 1000), 5)+1, '000');
      SET DESCRIPTION = CONCAT('Description for ', TOTAL_NAME);
      SET COUNT = ROUND(RAND() * 1000);
      SET PRICE = ROUND(RAND() * 10000, 2);

      INSERT INTO mindk_shop.products (product_id, product_name, product_count, product_description, product_price, product_available, product_visible)
      VALUES (PRODUCT_COUNT,TOTAL_NAME, COUNT, DESCRIPTION, PRICE, 1, 1);
      Commit;
      INSERT INTO mindk_shop.pictures (picture_product_id, picture_file_type, picture_file_name)
      VALUES (PRODUCT_COUNT, RANDOM_NAME_PART, concat((MOD(ROUND(RAND() * 1000), 5)), '.jpg'));
      SET PRODUCT_COUNT = PRODUCT_COUNT + 1;
    END WHILE;
    COMMIT;
  END;

CREATE PROCEDURE place_products(IN LOOPS INT)
  BEGIN
    DECLARE done INT;
    DECLARE product_num INT;
    DECLARE map_count INT;
    DECLARE category INT;
    DECLARE LOOP_COUNT INT DEFAULT 0;
    DECLARE product_cursor CURSOR FOR
      SELECT product_id
      FROM mindk_shop.products;
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

    WHILE LOOP_COUNT < LOOPS DO
      SET done = 0;

      OPEN product_cursor;
      FETCH product_cursor
      INTO product_num;

      WHILE done = 0 DO
        SET category = mod(round(rand() * 100), 6) + 1;
        IF category = 1 THEN
          SET category = 8;
        END IF;
        IF category = 3 THEN
          SET category = 9;
        END IF;
        IF category = 6 THEN
          SET category = 10;
        END IF;

        SELECT COUNT(*)
        INTO map_count
        FROM category2products_map
        WHERE cat2prod_map_product_id = product_num
        and cat2prod_map_category_id = category;
        IF (map_count = 0) AND (MOD(ROUND(RAND()*1000), 2) = 1)
        THEN
          INSERT INTO mindk_shop.category2products_map (cat2prod_map_category_id, cat2prod_map_product_id)
          VALUES (category, product_num);
          COMMIT;
        END IF;
        FETCH product_cursor
        INTO product_num;
      END WHILE;

      CLOSE product_cursor;
      SET LOOP_COUNT = LOOP_COUNT + 1;
    END WHILE;
  END;

CALL generate_products(300);
CALL place_products(3);