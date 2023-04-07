<?php
include '../conexao.php';
$sql = 'SELECT * FROM comidas';
$consulta = mysqli_query($mysqli, $sql);
$reuturn = array();
$x = 1;
    while ($linha  = mysqli_fetch_array($consulta)) {
        $return[$x] = array(
            "id" => $linha ['id_comida'],
            "nome" => $linha["nome_comida"],
            "preco" => $linha['preco_comida'], "estoque" => $linha ['estoque_comida'],
            "tipo" => $linha['tipo'],
            "categoria" => $linha [ 'categoria'],
            "descricao" => $linha ['descricao_comida']
        );
        $x++;
    }
echo json_encode($return);