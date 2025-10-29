create database farmacia_db;
use farmacia_db;

CREATE TABLE remedios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    codigo ENUM('TIPO A', 'TIPO B', 'TIPO C') NOT NULL DEFAULT 'TIPO A',
    tipo ENUM('Comprimido', 'Xarope', 'Pomada', 'Injeção') NOT NULL DEFAULT 'Comprimido',
    estoque INT NOT NULL,
    validade DATE NOT NULL,
    laboratorio VARCHAR(100) NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);