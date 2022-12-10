<?php
include_once('banco.php');
$dados = $_POST;
$banco = new Banco;
$conn = $banco->conectar();

// dependendo do valor que vier em registro, nós inserimos em uma tabela diferente
// 1 = ingrediente
// 2 = item
// 3 = cardapio

switch ($dados['registro']) {
        case 2:
                $query = $conn->prepare('DELETE FROM produto WHERE produto_id = :id;');        
                $query->execute([
                    ':id' => $dados['produto_id']
                ]);
                header('location:..\frontend\produto.php');
                break;
        
        case 3:
                $query = $conn->prepare('DELETE FROM pedido WHERE pedido_id = :id;');        
                $query->execute([
                    ':id' => $dados['pedido_id']
                ]);
                header('location:..\frontend\pedidos.php');
                break;
        
    }
