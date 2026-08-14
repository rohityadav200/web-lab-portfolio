CREATE DATABASE IF NOT EXISTS employee_db;

USE employee_db;

CREATE TABLE IF NOT EXISTS employees (
    employee_id VARCHAR(20) PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    gender VARCHAR(20),
    dob DATE,
    department VARCHAR(50),
    designation VARCHAR(100),
    salary DECIMAL(10,2),
    address TEXT
);
select * from employees
