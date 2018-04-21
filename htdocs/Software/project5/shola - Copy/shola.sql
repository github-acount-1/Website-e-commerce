DROP DATABASE IF EXISTS shola;
CREATE DATABASE shola;
USE shola;

DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS item_image;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS customer;

CREATE TABLE customer(
	user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(30) NOT NULL,
	last_name varchar(30) NOT NULL,
	user_name varchar(30) NOT NULL UNIQUE KEY,
	password varchar(40) NOT NULL,
	email varchar(50) NOT NULL UNIQUE KEY,
	phone_number varchar(20) NOT NULL UNIQUE KEY,
	country varchar(20) NOT NULL,
	city varchar(20) NOT NULL,
	birth_date date NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS items;
CREATE TABLE IF NOT EXISTS items (
  item_id varchar(50) NOT NULL PRIMARY KEY,
  item_name varchar(50) NOT NULL,
  description text NOT NULL,
  quantity int(11) NOT NULL,
  model varchar(50) NOT NULL DEFAULT 'no model',
  color varchar(30) NOT NULL DEFAULT 'none',
  category varchar(50) NOT NULL,
  post_date date NOT NULL,
  contract_period int(11) NOT NULL,
  user_id int NOT NULL,
  weight double DEFAULT NULL,
  price double NOT NULL,
  old_price double DEFAULT NULL,
  split_pay tinyint(1) DEFAULT NULL,
  FOREIGN KEY(user_id) REFERENCES customer(user_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS item_image;
CREATE TABLE IF NOT EXISTS item_image(
	item_id varchar(50) NOT NULL PRIMARY KEY,
	image_url varchar(500),
	FOREIGN KEY(item_id) REFERENCES items(item_id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS `category` (
  id int(11) NOT NULL AUTO_INCREMENT,
  category_name varchar(25) NOT NULL,
  PRIMARY KEY (id,category_name)
) ENGINE=InnoDB;
 

DROP TABLE IF EXISTS administrator;
CREATE TABLE administrator (
	admin_name varchar(30) NOT NULL,
	password varchar(30) NOT NULL
) ENGINE=InnoDB;


INSERT INTO customer set first_name="harry", last_name="potter", user_name="hp", 
			password= md5(123), email="hp@g.c", phone_number="123456", country="england", city="london";

INSERT INTO customer set first_name="ron", last_name="weasl", user_name="ron", 
			password= md5(123), email="ron@g.c", phone_number="2123456", country="england", city="london";