CREATE DATABASE store;
USE store;

CREATE TABLE items (
  itemID INT(11) NOT NULL AUTO_INCREMENT,
  itemName VARCHAR(255) NOT NULL DEFAULT '',
  itemPrice FLOAT NOT NULL DEFAULT '0',
  PRIMARY KEY (itemID)
) ENGINE=InnoDB;

INSERT INTO items VALUES (1, 'Paperweight', 3.99);
INSERT INTO items VALUES (2, 'Key ring', 2.99);
INSERT INTO items VALUES (3, 'Commemorative plate', 14.99);
INSERT INTO items VALUES (4, 'Pencils (set of 4)', 1.99);
INSERT INTO items VALUES (5, 'Coasters (set of 3)', 4.99);
