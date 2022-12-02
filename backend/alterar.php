<?php
include_once('conecta.php');
$dados = $_POST;
$banco = new Banco;
$conn = $banco->conectar();

// dependendo do valor que vier em registro, nós inserimos em uma tabela diferente
// 1 = produto
// 2 = item
// 3 = cardapi


switch ($dados['registro']) {
    case 1:
        $query = $conn->prepare(' UPDATE produto SET nome = :nome, valor = :valor, tipo = :tipo  WHERE produto_id = :id ;');        
        $query->execute([
            ':id' => $dados['produto_id'],
            ':nome' => $dados['nomeProduto'],
            ':valor' => $dados['valorProduto'],
            ':tipo' => $dados['tipoProduto']
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
            $query = $conn->prepare('UPDATE cardapio SET dt = :dt, tipo = :tipo, nutricionista_id = :nutricionista WHERE cardapio_id = :id;');        
            $query->execute([
                ':id' => $dados['cardapio_id'],
                ':dt' => $dados['data'],
                ':tipo' => $dados['tipo'],
                ':nutricionista' => $dados['nutricionista']
    
            ]);
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
    }
?>