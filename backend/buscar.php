<?php
include_once('banco.php');
$dados = $_POST;
$banco = new Banco;
$conn = $banco->conectar();



switch ($pesquisa) {

    case 1: //selecionar sem data específica
        $query = $conn->query('SELECT * FROM produto'); 
        return $query->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //selecionar por data ex:0000-00-00
        $query = $conn->prepare('SELECT item.item_id, cardapio.cardapio_id, item.descricao as nome_do_prato, GROUP_CONCAT(ingrediente.nome SEPARATOR ", ") 
            as ingredientes, DATE_FORMAT(cardapio.dt,"%d/%m/%Y") as data_formatada, (CASE WHEN cardapio.tipo = 1 THEN "Café da Manhã" WHEN cardapio.tipo = 2 THEN "Almoço" WHEN cardapio.tipo = 3 THEN "Janta" END) as tipo_formatado, tipo, usuario_id, usuario.nome, usuario.crn,
            SUM(CASE WHEN ingrediente_item.item_id = ingrediente_item.item_id THEN calorias ELSE 0 END) as soma_das_calorias 
            from cardapio_item INNER JOIN cardapio ON cardapio_item.cardapio_id = cardapio.cardapio_id 
            INNER JOIN item on cardapio_item.item_id = item.item_id INNER JOIN ingrediente_item on item.item_id = ingrediente_item.item_id 
            INNER JOIN ingrediente on ingrediente_item.ingrediente_id = ingrediente.ingrediente_id INNER JOIN usuario on cardapio.nutricionista_id = usuario.usuario_id 
            WHERE week(dt) = week(:dt) and (cardapio.dt_exclusao = 0000-00-00 OR cardapio.dt_exclusao > CURRENT_TIMESTAMP()) GROUP BY dt, nome_do_prato, tipo;');
        $query->execute([
            ':dt' => $data
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
        break;  
}