drop database motorpro;

-- Expressçao SQL para criar banco de dados
CREATE DATABASE motorpro;

-- Expressão SQL para informar à IDE que este é o banco que estará em uso.
USE motorpro;

-- Expressão SQL para criar a tabela de usuários
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Expressão SQL para criar a tabela de formecedores
CREATE TABLE mecanico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);

-- Expressão SQL para criar a tabela de produtos relacionada via FK com a tabela de fornecedores
CREATE TABLE carro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mecanico INT,
    modelo VARCHAR(100) NOT NULL,
    descricao TEXT,
    placa DECIMAL(10, 2),
    FOREIGN KEY (mecanico_id) REFERENCES mecanico(id)
);

-- Expressão SQL para cadastrar um usuário
INSERT INTO usuarios (usuario, senha) VALUES ('matheus', MD5('123'));