CREATE DATABASE IF NOT EXISTS juniortest;
USE juniortest;


CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sku VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(30) NOT NULL,
    price INT NOT NULL
);

CREATE TABLE IF NOT EXISTS book (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    weight INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE IF NOT EXISTS disc (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    size INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE IF NOT EXISTS furniture (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    dimensions VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products (id)
);