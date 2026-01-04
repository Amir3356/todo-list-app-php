-- Create the database
CREATE DATABASE tasks_db;

-- Use the database
USE tasks_db;

-- Create users table
CREATE TABLE users ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) UNIQUE NOT NULL, 
    password_hash VARCHAR(255) NOT NULL 
);

-- Create tasks table
CREATE TABLE tasks ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(255) NOT NULL, 
    description TEXT, 
    completed BOOLEAN DEFAULT FALSE NOT NULL, 
    deadline DATE, 
    user_id INT NOT NULL, 
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE 
);