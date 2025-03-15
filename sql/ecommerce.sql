-- Create Database
CREATE DATABASE IF NOT EXISTS ecommerce;
USE ecommerce;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    base_price DECIMAL(10,2) NOT NULL,
    discount_percentage DECIMAL(5,2) DEFAULT 0,
    stock INT NOT NULL,
    category VARCHAR(100),
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Admin Table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Admin User (Username: admin, Password: admin123)
INSERT INTO admin (username, password) VALUES ('admin@gmail.com', 'admin123');

-- Sample Products
INSERT INTO products (name, description, base_price, discount_percentage, stock, category, image_url)
VALUES
('Laptop', 'High-performance laptop.', 80000.00, 10.00, 20, 'Electronics', 'images/laptop.jpg'),
('Smartphone', 'Latest smartphone model.', 50000.00, 5.00, 30, 'Electronics', 'images/smartphone.jpg'),
('Shoes', 'Comfortable running shoes.', 3000.00, 15.00, 50, 'Fashion', 'images/shoes.jpg');

-- Dynamic Pricing View (Calculates Final Price)
CREATE VIEW dynamic_pricing AS
SELECT id, name, description, 
       base_price, 
       (base_price - (base_price * (discount_percentage / 100))) AS final_price,
       stock, category, image_url
FROM products;


