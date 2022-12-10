DROP DATABASE IF EXISTS mhds;

CREATE DATABASE IF NOT EXISTS mhds;

USE mhds;

CREATE TABLE IF NOT EXISTS usuario (
    usuario_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(40) NOT NULL,
    telefone VARCHAR(40) NOT NULL,
    email VARCHAR(120) NOT NULL,
    adm VARCHAR(23),
    PRIMARY KEY (usuario_id)
);

CREATE TABLE IF NOT EXISTS produto (
    produto_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(40) NOT NULL,
    valor FLOAT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    estocavel INT NOT NULL,
    quantidade INT NOT NULL,
    PRIMARY KEY (produto_id)
);

CREATE TABLE IF NOT EXISTS pedido (
    pedido_id INT NOT NULL AUTO_INCREMENT,
    dia VARCHAR(100) NOT NULL,
    hora VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    entregue INT NOT NULL,
    usuario_id INT NOT NULL,
    PRIMARY KEY (pedido_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS produtos (
    produtos_id INT NOT NULL,
    quantidade INT NOT NULL,
    produto_id INT NOT NULL,
    pedido_id INT NOT NULL,
    INDEX (produtos_id),
    FOREIGN KEY (produto_id) REFERENCES produto(produto_id) ON DELETE CASCADE,
    FOREIGN KEY (pedido_id) REFERENCES pedido(pedido_id) ON DELETE CASCADE
);

INSERT INTO usuario (nome, senha, telefone, email, adm) VALUES ('Mateus', '123', '51 920221709', 'mateus.haupt@gmail.com', 1);
INSERT INTO usuario (nome, senha, telefone, email) VALUES ('Lavínia', '1234', '51 917092022', 'laviniapga@gmail.com')