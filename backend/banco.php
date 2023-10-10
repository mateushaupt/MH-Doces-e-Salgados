<?php

class Banco

{

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_DATABASE = "mhds";

function conectar(){
$conn = new PDO("mysql:host=" . SELF::DB_HOST . ";dbname=" . SELF::DB_DATABASE . ";charset:utf8", SELF::DB_USER, SELF::DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $conn;
}

function autenticaConexao($usuario){
    $conn = $this->conectar();
    $query = $conn->query('SELECT * FROM usuario WHERE usuario_id = ' . $usuario);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function autentica($usuario){
    $conn = $this->conectar();
    $query = $conn->query('SELECT * FROM usuario WHERE adm = 1 AND usuario_id = ' . $usuario);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscaProduto(){
    $conn = $this->conectar();
    $query = $conn->query('SELECT * FROM produto'); 
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscaEstoque(){
    $conn = $this->conectar();
    $query = $conn->query('SELECT produto.produto_id, produto.nome, produto.estocavel, produto.quantidade as quantidade_disp, 
    SUM(CASE WHEN produto.produto_id = produtos.produto_id THEN produtos.quantidade ELSE 0 END) as quantidade_nesc 
    FROM produto 
    INNER JOIN produtos on produto.produto_id = produtos.produto_id 
    INNER JOIN pedido on produtos.pedido_id = pedido.pedido_id 
    WHERE produto.estocavel = 1 AND pedido.dia >= CURDATE() AND pedido.entregue = 0 
    GROUP BY produto_id');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscaPedido($usuario){
    $conn = $this->conectar();
    $query = $conn->query('SELECT pedido.pedido_id,  pedido.nome, CONCAT_WS(", ", pedido.cidade, pedido.bairro, pedido.rua) as endereco, pedido.usuario_id, ROUND(SUM(produtos.quantidade * produto.valor)) as valor, DATE_FORMAT(pedido.dia,"%d/%m/%Y") as dia, pedido.hora
    FROM pedido
    INNER JOIN produtos on pedido.pedido_id = produtos.produtos_id
    INNER JOIN produto on produto.produto_id = produtos.produto_id
    WHERE pedido.usuario_id = ' . $usuario . '
    GROUP BY pedido.pedido_id
    ORDER BY pedido.pedido_id DESC');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscaPedidos(){
    $conn = $this->conectar();
    $query = $conn->query('SELECT pedido.pedido_id, pedido.entregue, usuario.usuario_id, pedido.nome, CONCAT_WS(", ", DATE_FORMAT(pedido.dia,"%d/%m/%Y"), pedido.hora) as dia_hora 
    FROM pedido
    INNER JOIN usuario on pedido.usuario_id = usuario.usuario_id
    GROUP BY pedido.pedido_id
    ORDER BY pedido.pedido_id DESC');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscaVisuPedido($pedido){
    $conn = $this->conectar();
    $query = $conn->query('SELECT pedido.pedido_id, pedido.nome, CONCAT_WS(", ", pedido.cidade, pedido.bairro, pedido.rua) as endereco, pedido.usuario_id, ROUND(SUM(produtos.quantidade * produto.valor)) as valor, DATE_FORMAT(pedido.dia,"%d/%m/%Y") as dia, pedido.hora
    FROM pedido
    INNER JOIN produtos on pedido.pedido_id = produtos.produtos_id
    INNER JOIN produto on produto.produto_id = produtos.produto_id
    WHERE pedido.pedido_id = ' . $pedido . ' AND produtos.quantidade > 0
    GROUP BY pedido.pedido_id');
    return $query->fetch(PDO::FETCH_ASSOC);
}

function buscaVisuTwoPedido($pedido){
    $conn = $this->conectar();
    $query = $conn->query('SELECT produtos.quantidade, produto.nome, produto.tipo
    FROM pedido
    INNER JOIN produtos on pedido.pedido_id = produtos.produtos_id
    INNER JOIN produto on produto.produto_id = produtos.produto_id
    WHERE pedido.pedido_id = ' . $pedido . ' AND produtos.quantidade > 0
    GROUP BY produto.produto_id');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

}