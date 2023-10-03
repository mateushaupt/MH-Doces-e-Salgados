<?php
include_once('banco.php');

$dados = $_POST;
$banco = new Banco;
try {
    $conn = $banco->conectar();
} catch (PDOException $e) {
    echo 'Falha ao salvar os arquivos. Favor, tente mais tarde.';
}

// dependendo do valor que vier em registro, nós inserimos em uma tabela diferente
// 3 = usuario


// Faz um INSERT diferente, de acordo com os números que vierem representando as tabelas
switch ($dados['registro']) {

    case 2:
        $query = $conn->prepare('INSERT INTO pedido (dia, hora, cidade, bairro, rua, usuario_id, entregue) VALUES (:dia, :hora, :cidade, :bairro, :rua, :usuario_id, :entregue);');
        $query->execute([
            ':dia' => $dados['dia'],
            ':hora' => $dados['hora'],
            ':cidade' => $dados['cidade'],
            ':bairro' => $dados['bairro'],
            ':rua' => $dados['rua'],
            ':usuario_id' => $dados['usuario_id'],
            ':entregue' => $dados['entregue']
        ]);

        $pedido_id = pegaUltimoIdPedido($conn);

        foreach ($dados['produtos'] as $key => $val) {
            $query = $conn->prepare('INSERT INTO produtos (produtos_id, quantidade, produto_id, pedido_id) VALUES (:produtos_id, :quantidade, :produto_id, :pedido_id);');
            $query->bindValue(':produtos_id', $pedido_id[0]); 
            $query->bindValue(':quantidade', $val[0]); 
            $query->bindValue(':produto_id', $key);
            $query->bindValue(':pedido_id', $pedido_id[0]);
            $query->execute();
            header('location:..\frontend\pedidos.php');
        }

        break;
        //usuario
    case 3:
        if ($dados['senha'] == $dados['confirmasenha']) {
            $query = $conn->prepare('SELECT * FROM usuario WHERE email = :email');
            $query->execute([
                ':email' => $dados['email']
            ]);
            // Se houver um item com esse nome no banco, ele não insere
            if ($query->fetch(PDO::FETCH_ASSOC) == null) {
                $query = $conn->prepare('INSERT INTO usuario (nome, senha, email, telefone) VALUES (:nome, :senha, :email, :telefone);');
                $query->execute([
                    ':nome' => $dados['nome'],
                    ':senha' => $dados['senha'],
                    ':email' => $dados['email'],
                    ':telefone' => $dados['telefone']
                ]);
                header('location:..\frontend\login.php');
                echo "<script>alert('Conta cadastrada com sucesso!');</script>";
            } else {
                // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
                die('Já existe um usuário com o mesmo email cadastrado');
            }
            break;
        }

    case 4:
        if ($dados) {
            $query = $conn->prepare('SELECT * FROM produto WHERE nome = :nome');
            $query->execute([
                ':nome' => $dados['nomeProduto']
            ]);
            if ($dados['tipoProduto'] === "") {
                header('location:..\frontend\cadastroProduto.php');
                echo "<script>alert('Selecione um tipo');</script>";
            }
            // Se houver um item com esse nome no banco, ele não insere
            if ($query->fetch(PDO::FETCH_ASSOC) == null) {
                $query = $conn->prepare('INSERT INTO produto (nome, valor, tipo, estocavel, quantidade) VALUES (:nome, :valor, :tipo, :estocavel, :quantidade);');
                $query->execute([
                    ':nome' => $dados['nomeProduto'],
                    ':valor' => str_replace(',', '.', $dados['valorProduto']),
                    ':tipo' => $dados['tipoProduto'],
                    ':estocavel' => $dados['estocavel'],
                    ':quantidade' => $dados['quantidade']
                ]);
                header('location:..\frontend\produto.php');
                echo "<script>alert('Produto cadastrado com sucesso!');</script>";
            } else {
                // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
                die('Já existe um produto com o mesmo nome cadastrado');
            }
            break;
        }
}

function pegaUltimoIdPedido($conn) {
    $query = $conn->prepare("SELECT MAX(pedido_id) FROM pedido");
    $query->execute();
    return $query->fetch(PDO::FETCH_NUM);
}

function pegaUltimoId($conexao)
{
    $query = $conexao->prepare("SELECT LAST_INSERT_ID()");
    $query->execute();
    return $query->fetch(PDO::FETCH_NUM);
}
