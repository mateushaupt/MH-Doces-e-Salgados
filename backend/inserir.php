<?php
include_once('conecta.php');
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
switch ($dados['registro1']) {

        //usuario
    case 3:
        if($dados['password1'] == $dados['confirmpassword1']){
        $query = $conn->prepare('SELECT * FROM usuario WHERE email = :email');
        $query->execute([
            ':email' => $dados['email1']           
        ]);
        // Se houver um item com esse nome no banco, ele não insere
        if($query->fetch(PDO::FETCH_ASSOC) == null){
            $query = $conn->prepare('INSERT INTO usuario (nome, senha, email, telefone) VALUES (:nome, :senha, :email, :telefone);');
        $query->execute([
            ':nome' => $dados['nome1'],
            ':senha' => $dados['password1'],
            ':email' => $dados['email1'],
            ':telefone' => ($dados['contact1'])
        ]);
        
        } else{
            // Por enquanto só morre, depois mostrar de forma mais amigável para o usuário
            die('Já existe um usuário com o mesmo email cadastrado');
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