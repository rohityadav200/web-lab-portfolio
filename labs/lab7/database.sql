CREATE DATABASE company_db;

USE company_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('employee', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users
(name, email, password, role)
VALUES
(
    'Rahul Employee',
    'employee@technova.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzK0cGJ4FjZrR2M9K',
    'employee'
),
(
    'Admin User',
    'admin@technova.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCzK0cGJ4FjZrR2M9K',
    'admin'
);