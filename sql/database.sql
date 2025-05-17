/*
Web Programming II, CSIT-207
Project part II

Fred Animal Shelter Database
Author: Jiwon Chae and Hannah Lombardi
Date: 5/16/2025

File Name: database.sql

This is Fred Animal Shelter Database with sample inputs.

database.sql was imported to phpMyAdmin to be used as Fred Animal Shelter Database.

*/

-- Create the database
CREATE DATABASE IF NOT EXISTS animal_shelter;
USE animal_shelter;

-- 1. Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Pets table
CREATE TABLE IF NOT EXISTS pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    species VARCHAR(50) NOT NULL,
    breed VARCHAR(100),
    age INT,
    status ENUM('available', 'adopted') DEFAULT 'available',
    image_url VARCHAR(255)
);

-- 3. Adoption Requests table
CREATE TABLE IF NOT EXISTS adoption_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pet_id INT NOT NULL,
    message TEXT,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);

-- 4. Donations table
CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    card_last4 VARCHAR(4),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Volunteers table
CREATE TABLE IF NOT EXISTS volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    availability VARCHAR(20) NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample users
-- using PHP password_hash()
-- password: test123
INSERT INTO users (username, email, password) VALUES
('alice', 'alice@example.com', '$2y$10$OemCKYyDqLJbUJv6V6ScWuM3yTqDsdhmtNU1up7kxFxTk6CQwON8y'),
('bob', 'bob@example.com', '$2y$10$YyK0SDg9FZ9L8vJzFGhDsez3vDeqKdNKuNRYMe0B9I0csTY0Nv1pK');

-- Sample pets
INSERT INTO pets (name, species, breed, age, status, image_url) VALUES
('Max', 'Dog', 'Labrador', 3, 'available', 'images/max.jpg'),
('Whiskers', 'Cat', 'Siamese', 2, 'available', 'images/whiskers.jpg'),
('Bubbles', 'Dog', 'Poodle', 1, 'adopted', 'images/bubbles.jpg');

-- Sample adoption requests
INSERT INTO adoption_requests (user_id, pet_id, message) VALUES
(1, 1, 'I would love to adopt Max!'),
(2, 2, 'Whiskers is adorable! I have a great home.');

-- Sample donations
INSERT INTO donations (name, email, amount, card_last4) VALUES
('Jane Doe', 'jane@example.com', 25.00, '1234'),
('John Smith', 'john@example.com', 100.00, '5678');

-- Sample volunteers
INSERT INTO volunteers (name, age, email, availability) VALUES
('Emily Clark', 19, 'emily@example.com', 'Weekdays'),
('David Lee', 22, 'david@example.com', 'Anytime');