DROP DATABASE IF EXISTS motorpro;

CREATE DATABASE motorpro;

USE motorpro;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE mecanico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);

CREATE TABLE carro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mecanico_id INT,
    modelo VARCHAR(100) NOT NULL,
    descricao TEXT,
    placa VARCHAR(8),
    FOREIGN KEY (mecanico_id) REFERENCES mecanico(id)
);

INSERT INTO clientes (usuario, senha) VALUES ('matheus', MD5('123'));

INSERT INTO mecanico (nome, email, telefone) VALUES ('João', 'joaomarquito@gmail.com', '11 91245 1249');

INSERT INTO carro (mecanico_id, modelo, descricao, placa) VALUES (1, 'Ford Ka', 'Troca de óleo', 'ASG8I47');

SELECT* FROM carro;

SELECT* FROM mecanico;