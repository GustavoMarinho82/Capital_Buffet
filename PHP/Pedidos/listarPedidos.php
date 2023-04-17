<?php
include "../conexao.php";

$sql = "SELECT * FROM pedidos";
    $consulta = mysqli_query($mysqli, $sql);
$x = 0;
$return = array();

while ($linha = mysqli_fetch_array($consulta)) {
    $id_p=$linha["id_pedido"];
    $t=$linha["tipo_evento"];
    $o=$linha["orcamento"];
    $s=$linha["status_pedido"];
    $d=$linha["data_pedido"];
    $i_e=$linha["inicio_evento"];
    $f=$linha["fim_evento"];
    $c=$linha["qtd_convidados"];
    $e=$linha["endereco"];
    $obs=$linha["observacoes"];
    $id_u=$linha["usuario_id"];

    $return[$x] = array(
        "id" => $id_p,
        "tipo" => $t,
        "orcamento" => $o,
        "status" => $s,
        "data" => $d,
        "inicio" => $i_e,
        "fim" => $f,
        "convidados" => $c,
        "endereco" => $e,
        "observacoes" => $obs,
        "usuario" => $id_u
    );
    
    $x++;
}

echo json_encode($return);
