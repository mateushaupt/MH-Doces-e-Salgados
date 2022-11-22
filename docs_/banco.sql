DROP DATABASE mhds;

CREATE DATABASE IF NOT EXISTS mhds;

USE mhds;

CREATE TABLE IF NOT EXISTS usuario (
    usuario_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(40) NOT NULL,
    telefone VARCHAR(40) NOT NULL,
    email VARCHAR(120) NOT NULL,
    PRIMARY KEY (usuario_id)
);

CREATE TABLE IF NOT EXISTS pedido (
    pedido_id INT NOT NULL AUTO_INCREMENT,
    valor_total INT NOT NULL,
    dia_hora DATETIME NOT NULL,
    produtos_id INT NOT NULL,
    PRIMARY KEY (pedido_id)
);

CREATE TABLE IF NOT EXISTS produto (
    produto_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(40) NOT NULL,
    valor INT NOT NULL,
    PRIMARY KEY (produto_id)
);

CREATE TABLE IF NOT EXISTS produtos (
    produtos_id INT NOT NULL,
    quantidade INT NOT NULL,
    produto_id INT NOT NULL,
    PRIMARY KEY (produtos_id)
)

