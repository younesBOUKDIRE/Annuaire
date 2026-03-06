CREATE DATABASE annuaire;
USE annuaire;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    role ENUM('USER','ADMIN') DEFAULT 'USER'
);

CREATE TABLE entreprises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200),
    categorie VARCHAR(100),
    adresse TEXT,
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    telephone VARCHAR(20),
    email VARCHAR(150),
    site_web VARCHAR(200),
    description TEXT,
    logo VARCHAR(255),
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

INSERT INTO users (name, email, password, role)
VALUES (
  'Admin',
  'admin@annuaire.com',
  '$2y$10$eXAUZSkOI2OKMGhIXs3cU.6D8q4klhcDQq6R5zPVgO8gStUbAlVY2',
  'ADMIN'
);

--admin password is admin123
