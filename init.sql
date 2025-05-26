DROP DATABASE IF EXISTS sqli_project;
CREATE DATABASE IF NOT EXISTS sqli_project;
USE sqli_project;

DROP TABLE IF EXISTS utenti;

CREATE TABLE IF NOT EXISTS utenti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    ruolo VARCHAR(20)
);

INSERT INTO utenti (nome, cognome, username, password, telefono, email, ruolo) VALUES
('Mario', 'Rossi', 'admin', 'admin123', '+39 3912499912', 'admin@example.com', 'admin'),
('Paola', 'Bianchi', 'user1', 'userpass', '+39 3369230134', 'user1@example.com', 'user'),
('Luca', 'Verdi', 'user2', '123456', '+39 3333777332', 'user2@example.com', 'user');