CREATE DATABASE IF NOT EXISTS ecommerce;

USE ecommerce;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    parent_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO categories (name, slug, parent_id) VALUES 
('Điện lạnh', 'dien-lanh', NULL),
('Điện tử', 'dien-tu', NULL),
('Điện gia dụng', 'dien-gia-dung', NULL),
('Phụ kiện', 'phu-kien', NULL);

INSERT INTO categories (name, slug, parent_id) VALUES 
('Máy lạnh', 'may-lanh', 1),
('Tủ đông', 'tu-dong', 1),
('Tủ mát', 'tu-mat', 1);

INSERT INTO categories (name, slug, parent_id) VALUES 
('Tivi', 'tivi', 2),
('Dàn âm thanh', 'dan-am-thanh', 2);

INSERT INTO categories (name, slug, parent_id) VALUES 
('Máy giặt', 'may-giat', 3),
('Nồi cơm điện', 'noi-com-dien', 3);

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255),
    address VARCHAR(255),
    phone VARCHAR(15),
    role ENUM("admin", "user"),
    api_key VARCHAR(255),
    UNIQUE (username)
);

INSERT INTO users (id, name, username, password, address, phone, role, api_key) VALUES
(1, 'Karl', 'karl', '1990', NULL, NULL, 'admin', NULL),
(2, 'Jack', 'jack', '2000', NULL, NULL, 'user', NULL),
(3, 'Anthony', 'anthony', '1998', NULL, NULL, 'user', NULL),
(4, 'Amy', 'amy', '1990', NULL, NULL, 'user', NULL);

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    category_id INT,
    price VARCHAR(255),
    imgURL VARCHAR(255),
    brand VARCHAR(255),
    description VARCHAR(255),
    UNIQUE (name, category_id, brand),
    CONSTRAINT FOREIGN KEY (category_id) REFERENCES categories (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

INSERT INTO products (id, name, category_id, price, imgURL, brand, description) VALUES
(1, 'điều hoà', 1, '1990', 'https://tongkhodienmaymienbac.com/wp-content/uploads/2021/04/ckeditor_1960450-6.jpg', 'aqua', 'ok'),
(2, 'điều hoà', 1, '1990', 'https://donoidia.com/wp-content/uploads/2023/11/dieu-hoa-panasonic-cs-223dfl-2.jpg', 'panasonic', 'ok'),
(3, 'máy lọc nước', 2, '1990', 'https://maylocnuocaqua.com.vn/wp-content/uploads/2022/08/z3923847192228_ee6164c763f22b0e307f162dc8b982b8.jpg', 'aqua', 'ok'),
(4, 'máy lọc nước', 2, '1990', '', 'panasonic', 'ok'),
(5, 'bep ga', 3, '10000', 'http://', 'havana', 'beautiful');

CREATE TABLE IF NOT EXISTS chat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    message VARCHAR(255),
    date DATETIME,
    CONSTRAINT FOREIGN KEY (product_id) REFERENCES products (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    quantity INT,
    unitPrice INT,
    user_id INT,
    date DATETIME,
    CONSTRAINT FOREIGN KEY (product_id) REFERENCES products (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS payment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    amount INT,
    date DATETIME,
    method ENUM("banking transfer", "cash"),
    CONSTRAINT FOREIGN KEY (order_id) REFERENCES orders (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS api_keys (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    api_key VARCHAR(255),
    UNIQUE (user_id),
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

INSERT INTO api_keys (id, user_id, api_key) VALUES
(1, 1, '83dac5c7725b9614503f97fe4ee5ae2c');
