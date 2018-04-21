DROP DATABASE IF EXISTS bank;
CREATE database bank;
USE BANK;
CREATE TABLE bank_account
(
  account_number bigint,
  first_name character varying(50),
  last_name character varying(50),
  credit_card_number integer,
  phone_number bigint,
  email character varying(100),
  PRIMARY KEY (account_number)
);
CREATE TABLE credit_card(
  credit_card_number integer,
  zip_code integer,
  account_number bigint,
  security_code character varying(400),
  PRIMARY KEY (credit_card_number),
  FOREIGN KEY (account_number) REFERENCES bank_account(account_number)
);

/*end bank*/

DROP DATABASE IF EXISTS shola;
CREATE DATABASE shola;
USE shola;

DROP TABLE IF EXISTS fquestions;
DROP TABLE IF EXISTS fanswer;
DROP TABLE IF EXISTS user_preference;
DROP TABLE IF EXISTS split_pay_receipt;
DROP TABLE IF EXISTS shola_receipt;
DROP TABLE IF EXISTS shipper_receipt;
DROP TABLE IF EXISTS seller_receipt;
DROP TABLE IF EXISTS buyer_receipt;
DROP TABLE IF EXISTS auction_entrance_receipt;
DROP TABLE IF EXISTS advertisement_receipt;
DROP TABLE IF EXISTS credit_card_history;
DROP TABLE IF EXISTS advertisement;
DROP TABLE IF EXISTS shipping_distance;
DROP TABLE IF EXISTS shipping;
DROP TABLE IF EXISTS product_categories;
DROP TABLE IF EXISTS msg_notifs;
DROP TABLE IF EXISTS bid_report;
DROP TABLE IF EXISTS forum;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS my_coupons;
DROP TABLE IF EXISTS coupon_create;
DROP TABLE IF EXISTS item_discount;
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

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category (
  id int(11) NOT NULL AUTO_INCREMENT,
  category_name varchar(50) NOT NULL UNIQUE,
  PRIMARY KEY (id,category_name)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS items;
CREATE TABLE IF NOT EXISTS items (
  item_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  item_name varchar(50) NOT NULL,
  description text NOT NULL,
  quantity int(11) NOT NULL,
  model varchar(50) NOT NULL DEFAULT 'no model',
  color varchar(30) NOT NULL DEFAULT 'none',
  category varchar(50) NOT NULL,
  post_date date NOT NULL,
  contract_period int(11) NOT NULL,
  uploader_id int NOT NULL,
  weight double DEFAULT NULL,
  price double NOT NULL,
  old_price double DEFAULT NULL,
  split_pay tinyint(1) DEFAULT NULL,
  release_date date DEFAULT NULL,
  sell_count int default 0,
  hit_count int default 0,
  FOREIGN KEY(uploader_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY(category) REFERENCES category(category_name)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS item_image;
CREATE TABLE IF NOT EXISTS item_image(
	item_id int NOT NULL,
	image_url varchar(500),
  main_image boolean default false,
	FOREIGN KEY(item_id) REFERENCES items(item_id)
	ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

DROP TABLE IF EXISTS administrator;
CREATE TABLE administrator (
	admin_name varchar(30) NOT NULL,
	password varchar(40) NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS item_discount;
CREATE TABLE IF NOT EXISTS item_discount (
  discount_id int(11) NOT NULL,
  discount_code varchar(20) NOT NULL,
  discount_amount double NOT NULL,
  discount_type varchar(20) NOT NULL,
  create_date date NOT NULL,
  expiry_date date NOT NULL,
  status varchar(20) NOT NULL,
  item_id int NOT NULL,
  dicounted_price double NOT NULL,
  PRIMARY KEY (discount_id),
  FOREIGN KEY(item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS coupon_create;
CREATE TABLE coupon_create (
  offer_id int(11) NOT NULL PRIMARY KEY,
  item_id int NOT NULL,
  item_amount int(11) NOT NULL,
  free_item_id INT NOT NULL,
  free_item_amount int(11) NOT NULL,
  create_date date NOT NULL,
  expire_date date NOT NULL, 
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (free_item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS my_coupons;
CREATE TABLE my_coupons (
  coupon_code int(11) NOT NULL UNIQUE KEY,
  user_id int(11) NOT NULL,
  offer_id int(11) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES customer(user_id), 
  FOREIGN KEY(offer_id) REFERENCES coupon_create(offer_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id int not null AUTO_INCREMENT PRIMARY KEY,
  prod_id int NOT NULL ,
  question text NOT NULL,
  answer text NOT NULL,
  keywords varchar(255),
  count int(11) NOT NULL,
  FOREIGN KEY (prod_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

create table forum(
  post_id int AUTO_INCREMENT PRIMARY KEY,
  user_name varchar(20) NOT NULL,
  title varchar(50) not null,
  message TEXT not null,
  post_date datetime,
  FOREIGN KEY (user_name) REFERENCES customer(user_name)
  ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

create table store_reply(
  post_id int ,
  reply text not null,
  name_of_replier VARCHAR(40) not null,
  reply_date datetime,
  FOREIGN KEY (post_id) REFERENCES forum(post_id)
  ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB;

DROP TABLE IF EXISTS bid_report;
CREATE TABLE IF NOT EXISTS bid_report (
  bid_id int(11) NOT NULL AUTO_INCREMENT,
  product_id int(11) NOT NULL,
  bidder varchar(60) NOT NULL,
  bid_date_time varchar(60) NOT NULL,
  bid_amount int(11) NOT NULL,
  status int(11) NOT NULL,
  PRIMARY KEY (bid_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS msg_notifs;
CREATE TABLE IF NOT EXISTS msg_notifs (
  msg_notifs_id int(11) NOT NULL AUTO_INCREMENT,
  from_id varchar(11) NOT NULL,
  msg_not_if varchar(300) NOT NULL,
  date_created varchar(60) NOT NULL,
  PRIMARY KEY (msg_notifs_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS product_categories;
CREATE TABLE IF NOT EXISTS product_categories (
  category_id int(11) NOT NULL AUTO_INCREMENT,
  category_name varchar(50) NOT NULL,
  cat_image varchar(100) NOT NULL,
  category_des varchar(250) NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  product_id int(11) NOT NULL AUTO_INCREMENT,
  prod_name varchar(30) NOT NULL,
  category_id int(11) NOT NULL,
  pro_description varchar(300) NOT NULL,
  starting_bid int(11) NOT NULL,
  prod_image varchar(100) NOT NULL,
  date_posted date NOT NULL,
  due_date date NOT NULL,
  status varchar(15) NOT NULL,
  PRIMARY KEY (product_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS shipping;
CREATE TABLE shipping (
  user_id int NOT NULL,
  item_id int NOT NULL,
  home_number varchar(20) NOT NULL,
  arrival_date date NOT NULL,
  date_of_purchase date NOT NULL,
  distance_from_store int(11) NOT NULL,
  shipping_price double NOT NULL,
  tracking_number int(11) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS shipping_distance;
CREATE TABLE shipping_distance (
  subcity varchar(20) NOT NULL,
  distance double NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS advertisement;
CREATE TABLE advertisement (
  ad_id int not null PRIMARY KEY,
  user_id int NOT NULL,
 item_id int NOT NULL,
  advertisement_price double NOT NULL,
  show_date date NOT NULL,
  end_date date NOT NULL,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;


DROP TABLE IF EXISTS credit_card_history;
CREATE TABLE credit_card_history
(
  user_id integer,
  user_name character varying(50),
  credit_card_number integer NOT NULL,
  expiration_date date,
  CONSTRAINT credit_card_number PRIMARY KEY (credit_card_number),
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);
-- FOREIGN KEY  user_id and user_name from user database

-- advertisement receipt table
DROP TABLE IF EXISTS advertisement_receipt;
CREATE TABLE advertisement_receipt
(
  time_of_purchase date,
  seller_name character varying(50),
  user_id integer not null,
  advertisement_id integer,
  advertisement_duration int,
  cost_per_hour double,
  total_price double,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (advertisement_id) REFERENCES advertisement (ad_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);


-- auction entrance receipt
DROP TABLE IF EXISTS auction_entrance_receipt;
CREATE TABLE auction_entrance_receipt
(
  item_id int,
  item_name character varying(50),
  time_of_purchase date,
  user_id integer not null,
  buyer_name character varying(50),
  entrance_fee double precision,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);




-- buyer receipt table
DROP TABLE IF EXISTS buyer_receipt;
CREATE TABLE buyer_receipt
(
  item_id int,
  item_name character varying(50),
  item_cost double precision,
  item_quantity integer,
  time_of_purchase date,
  seller_name character varying(50),
  seller_address character varying(100),
  user_id integer,
  buyer_name character varying(50),
  buyer_address character varying(100),
  shipment_arrival date,
  tracking_number bigint,
  shipment_fee double precision,
  spilt_pay boolean,
  total_price double precision,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);




-- seller receipt table
DROP TABLE IF EXISTS seller_receipt;
CREATE TABLE seller_receipt
(
  item_id int,
  item_name character varying(50),
  item_cost double precision,
  item_quantity integer,
  time_of_purchase date,
  seller_name character varying(50),
  seller_address character varying(100),
  user_id integer,
  buyer_name character varying(50),
  buyer_address character varying(100),
  spilt_pay boolean,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS shipper_receipt;
CREATE TABLE shipper_receipt
(
  item_id int,
  item_name character varying(50),
  item_quantity integer,
  time_of_purchase date,
  seller_name character varying(50),
  seller_address character varying(100),
  user_id integer,
  buyer_name character varying(50),
  buyer_address character varying(100),
  shipment_arrival date,
  tracking_number bigint,
  shipment_fee double precision,
  spilt_pay boolean,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS shola_receipt;
CREATE TABLE shola_receipt
(
  item_id int,
  item_quantity integer,
  time_of_purchase date,
  seller_user_id integer,
  buyer_user_id integer,
  shipper_user_id integer,
  tracking_number bigint,
  item_cost double precision,
  shipment_fee double precision,
  total_price double precision,
  shola_cut double precision,
  spilt_pay boolean,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);




DROP TABLE IF EXISTS split_pay_receipt;
CREATE TABLE split_pay_receipt
(
  item_id int,
  item_name character varying(50),
  item_quantity integer,
  time_of_purchase date,
  seller_user_id integer,
  seller_name character varying(50),
  shipper_user_id integer,
  shipper_name character varying(50),
  buyer_user_id integer,
  buyer_name character varying(50),
  current_debt double precision,
  already_paid_seller double precision,
  already_paid_shipper double precision,
  already_paid_shola double precision,
  interest_rate double precision,
  total_price double precision,
  receipt_number integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FOREIGN KEY (item_id) REFERENCES items(item_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS user_data;
CREATE TABLE user_data(
  user_id int not null,
  category varchar(50) not null,
  score double default 0,
  updated datetime,
  UNIQUE(user_id, category),
  FOREIGN KEY(user_id) REFERENCES customer(user_id)
  ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS user_preference;
CREATE TABLE user_preference(
  user_id int not null,
  category varchar(50) not null,
  score double default 0,
  FOREIGN KEY(user_id) REFERENCES customer(user_id)
);


DROP TABLE IF EXISTS fquestions ;
CREATE TABLE fquestions (
  id int ( 4 ) NOT NULL AUTO_INCREMENT ,
  topic  varchar ( 255) NOT NULL DEFAULT '',
  detail  longtext NOT NULL ,
  name  varchar( 65 ) NOT NULL DEFAULT '',
  email varchar ( 65) NOT NULL DEFAULT '',
  datetime varchar ( 25 ) NOT NULL DEFAULT '',
  view int ( 4) NOT NULL DEFAULT '0' ,
  reply int ( 4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY ( id)
); 

DROP TABLE IF EXISTS fanswer;
CREATE TABLE fanswer (
  question_id  int ( 4 ) NOT NULL DEFAULT '0' ,
  a_id int ( 4) NOT NULL DEFAULT '0' ,
  a_name  varchar ( 65 ) NOT NULL DEFAULT '',
  a_email  varchar ( 65) NOT NULL DEFAULT '',
  a_answer  longtext NOT NULL ,
  a_datetime varchar ( 25) NOT NULL DEFAULT '',
  KEY a_id  ( a_id )
);

DROP TABLE IF EXISTS debt;
CREATE TABLE debt(
    debt_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    interest_rate double,
    item_name varchar(50),
    user_name varchar(30),
    item_id int not null,
    user_id int,
    remaining_debt double,
    FOREIGN KEY(user_id) REFERENCES customer(user_id)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(item_id) REFERENCES items(item_id)
    ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS notifications;
create TABLE notifications(
  notif_id int AUTO_INCREMENT PRIMARY KEY,
  user_id int,
  notification text,
  notif_date datetime,
  FOREIGN KEY(user_id) REFERENCES customer(user_id)
);

DROP TABLE IF EXISTS new_notification_count;
CREATE TABLE new_notification_count(
  user_id int NOT NULL ,
  new_notif_count int default 0,
  FOREIGN KEY(user_id) REFERENCES customer(user_id)
);

DROP TABLE IF EXISTS shopping_cart;
CREATE TABLE shopping_cart(
    user_id int not null,
    item_id int not null,
    quantity int default 0,
    FOREIGN KEY (user_id) REFERENCES customer(user_id),
    FOREIGN KEY (item_id) REFERENCES items(item_id)
);

CREATE TABLE IF NOT EXISTS  currencyconvertertable  (
   country_name  varchar(50) NOT NULL PRIMARY KEY,
   rate  double NOT NULL
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- INSERT INTO  currencyconvertertable  ( country_name ,  rate ) VALUES
-- ('ETB', 27.26),
-- ('EUR', 0.84),
-- ('GBP', 0.75),
-- ('USD', 1);

-- insert into category set category_name="Auto";
--   insert into category set category_name="Cloth";
--     insert into category set category_name="Shoes";
--       insert into category set category_name="Machinery";
--         insert into category set category_name="Cars";
--       insert into category set category_name="Laptops";
--         insert into category set category_name="Phones";
--           insert into category set category_name="Work Stations";


-- INSERT INTO customer set first_name="harry", last_name="potter", user_name="hp", 
-- 			password= md5(123), email="hp@g.c", phone_number="123456", country="england", city="london";

-- INSERT INTO items values ("at12", "chair", "this si", 2, "mod1", "red", "furniture", 
--       now(), 23, 1, 23.3, 1.1, 2.34, 1);

-- INSERT INTO customer set first_name="ron", last_name="weasl", user_name="ron", 
-- 			password= md5(123), email="ron@g.c", phone_number="2123456", country="england", city="london";
