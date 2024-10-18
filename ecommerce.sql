CREATE DATABASE IF NOT exists ecommerce;

USE ecommerce;

CREATE TABLE IF NOT exists user (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255),
    address VARCHAR(255),
    phone INT,
    role enum("admin", "user"),
    UNIQUE (username)
);

CREATE TABLE IF NOT exists category (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE IF NOT exists products (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    categoryID INT,
    price VARCHAR(255),
    imgURL VARCHAR(255),
    brand VARCHAR(255),
    description VARCHAR(255),
    UNIQUE (name, categoryID, brand),
    CONSTRAINT FOREIGN KEY (categoryID) REFERENCES category (categoryID)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT exists `order` (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    productID INT,
    quantity INT,
    unitPrice INT,
    userID INT,
    date DATETIME,
    CONSTRAINT FOREIGN KEY (productID) REFERENCES products (productID)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FOREIGN KEY (userID) REFERENCES user (userID)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT exists chat (
    chatID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    productID INT,
    message VARCHAR(255),
    date DATETIME,
    CONSTRAINT FOREIGN KEY (productID) REFERENCES products (productID)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FOREIGN KEY (userID) REFERENCES user (userID)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT exists payment (
    paymentID INT PRIMARY KEY AUTO_INCREMENT,
    orderID INT,
    amount INT,
    date DATETIME,
    method enum("banking transfer", "cash"),
    CONSTRAINT FOREIGN KEY (orderID) REFERENCES `order` (orderID)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);


INSERT INTO user (name, username, password, role) 
    VALUES 
        ("Karl", "karl", "1990", "admin"), 
        ("Jack", "jack", "2000", "user"), 
        ("Anthony", "anthony", "1998", "user"), 
        ("Amy", "amy", "1990", "user");


INSERT INTO category (name) 
    VALUES 
        ("điện lạnh"), 
        ("điện tử"),
        ("đồ dùng nhà bếp"),
        ("phụ kiện");

INSERT INTO products (name, categoryID, price, imgURL, brand, description) 
    VALUES 
        ("điều hoà", "1", "1990", "abc", "aqua", "ok"), 
        ("điều hoà", "1", "1990", "abc", "panasonic", "ok"), 
        ("máy lọc nước", "2", "1990", "abc", "aqua", "ok"), 
        ("máy lọc nước", "2", "1990", "abc", "panasonic", "ok")