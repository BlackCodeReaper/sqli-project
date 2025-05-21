DROP DATABASE IF EXISTS sqli_demo;
CREATE DATABASE IF NOT EXISTS sqli_demo;
USE sqli_demo;

DROP TABLE IF EXISTS utenti;

CREATE TABLE IF NOT EXISTS utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    ruolo VARCHAR(20)
);

INSERT INTO utenti (username, password, email, ruolo) VALUES
('admin', 'admin123', 'admin@example.com', 'admin'),
('user1', 'userpass', 'user1@example.com', 'user'),
('user2', '123456', 'user2@example.com', 'user');