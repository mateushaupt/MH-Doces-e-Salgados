<?php
include_once('banco.php');

$dados = $_POST;
$banco = new Banco;
try{
    $conn = $banco->conectar();
} catch(PDOException $e){
    echo 'Falha ao salvar os arquivos. Favor, tente mais tarde.';
}

// dependendo do valor que vier em registro, nós inserimos em uma tabela diferente
// 3 = usuario


// Faz um INSERT diferente, de acordo com os números que vierem representando as tabelas
switch ($dados['registro']) {

        //usuario
    case 3:
        if($dados['senha'] == $dados['confirmasenha']){
        $query = $conn->prepare('SELECT * FROM usuario WHERE email = :email');
        $query->execute([
            ':email' => $dados['email']           
        ]);
        // Se houver um item com esse nome no banco, ele não insere
        if($query->fetch(PDO::FETCH_ASSOC) == null){
            $query = $conn->prepare('INSERT INTO usuario (nome, senha, email, telefone) VALUES (:nome, :senha, :email, :telefone);');
        $query->execute([
            ':nome' => $dados['nome'],
            ':senha' => $dados['senha'],
            ':email' => $dados['email'],
            ':telefone' => $dados['telefone']
        ]);
        header('location:..\frontend\login.php');
        echo "<script>alert('Conta cadastrada com sucesso!');</script>";
        
        } else{
            // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
            die('Já existe um usuário com o mesmo email cadastrado');
        }
        break;
    }
    
    case 4:
        if($dados){
            $query = $conn->prepare('SELECT * FROM produto WHERE nome = :nome');
            $query->execute([
                ':nome' => $dados['nomeProduto']           
            ]);
        if($dados['tipoProduto'] === "") {
            header('location:..\frontend\cadastroProduto.php');
            echo "<script>alert('Selecione um tipo');</script>";
        }
        // Se houver um item com esse nome no banco, ele não insere
        if($query->fetch(PDO::FETCH_ASSOC) == null){
            $query = $conn->prepare('INSERT INTO produto (nome, valor, tipo) VALUES (:nome, :valor, :tipo);');
        $query->execute([
            ':nome' => $dados['nomeProduto'],
            ':valor' => $dados['valorProduto'],
            ':tipo' => $dados['tipoProduto']
        ]);
        header('location:..\frontend\produto.php');
        echo "<script>alert('Produto cadastrado com sucesso!');</script>";
        
        } else{
            // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
            die('Já existe um produto com o mesmo nome cadastrado');
        }
        break;
    } 
}

function pegaUltimoId($conexao){
    $query = $conexao->prepare("SELECT LAST_INSERT_ID()");
    $query->execute();
    return $query->fetch(PDO::FETCH_NUM);
}


?>