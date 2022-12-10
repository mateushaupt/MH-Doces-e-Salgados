<?php
include_once('banco.php');
$dados = $_POST;
$banco = new Banco;
$conn = $banco->conectar();

// dependendo do valor que vier em registro, nós inserimos em uma tabela diferente
// 1 = produto
// 2 = item
// 3 = cardapi


switch ($dados['registro']) {
    case 1:
        $query = $conn->prepare(' UPDATE produto SET nome = :nome, valor = :valor, tipo = :tipo, estocavel = :estocavel  WHERE produto_id = :id ;');        
        $query->execute([
            ':id' => $dados['produto_id'],
            ':nome' => $dados['nomeProduto'],
            ':valor' => $dados['valorProduto'],
            ':tipo' => $dados['tipoProduto'],
            ':estocavel' => $dados['estocavel'],
        ]);
        header('location:..\frontend\produto.php');
        echo "<script>alert('Produto editado com sucesso!');</script>";
        break;
        case 2:
            $query = $conn->prepare('UPDATE item SET descricao = :descricao WHERE item_id = :id;');        
            $query->execute([
                ':id' => $dados['item_id'],
                ':descricao' => $dados['descricao']            
            ]);
            break;
        case 3:        
            $query = $conn->prepare(' UPDATE produto SET quantidade = :quantidade  WHERE produto_id = :id ;');        
            $query->execute([
                ':id' => $dados['produto_id'],
                ':quantidade' => $dados['quantidade']
            ]);
            header('location:..\frontend\estoque.php');
            echo "<script>alert('Estoque do produto atualizado com sucesso!');</script>";
            break;

        case 4:
            $query = $conn->prepare('UPDATE usuario SET nome = :nome, telefone = :telefone, email = :email WHERE usuario_id = :id');
            $query->execute([
                ':id' => $dados['usuario_id'],
                ':nome' => $dados['nome'],
                ':telefone' => $dados['telefone'],
                ':email' => $dados['email']
                           
            ]);
            header('location:..\frontend\configUsuario.php');
            echo "<script>alert('Perfil editado com sucesso!');</script>";
            break;

        case 5:        
            $query = $conn->prepare(' UPDATE pedido SET entregue = :entregue  WHERE pedido_id = :id ;');        
            $query->execute([
                ':id' => $dados['pedido_id'],
                ':entregue' => $dados['entregue']
            ]);
            header('location:..\frontend\gerenciarPedidos.php');
            echo "<script>alert('Situação do pedido atualizado com sucesso!');</script>";
            break; 
    }
