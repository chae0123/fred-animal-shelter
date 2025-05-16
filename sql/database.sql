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


-- Sample users
INSERT INTO users (username, email, password) VALUES
('alice', 'alice@example.com', 'hashedpassword1'),
('bob', 'bob@example.com', 'hashedpassword2');

-- Sample pets
INSERT INTO pets (name, species, breed, age, status, image_url) VALUES
('Max', 'Dog', 'Labrador', 3, 'available', 'images/max.jpg'),
('Whiskers', 'Cat', 'Siamese', 2, 'available', 'images/whiskers.jpg'),
('Bubbles', 'Dog', 'Poodle', 1, 'adopted', 'images/bubbles.jpg');

-- Sample adoption requests
INSERT INTO adoption_requests (user_id, pet_id, message) VALUES
(1, 1, 'I would love to adopt Max!'),
(2, 2, 'Whiskers is adorable! I have a great home.');
