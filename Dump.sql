CREATE DATABASE IF NOT EXISTS foryourvoice;

USE foryourvoice;

CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(255),
    cidade_estado VARCHAR(255),
    cep INT,
    escolaridade VARCHAR(50),
    instdeensino VARCHAR(255),
    cargo VARCHAR(255),
    empresa VARCHAR(255),
    data_inicio DATE,
    data_fim DATE,
    infocomplementar TEXT
);