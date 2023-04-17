<?php

$abs_path = explode("/",str_replace("\\", "/",__DIR__));
$max = sizeof($abs_path);
$max--;
$include = "";
for($i = 0; $i < $max; $i++){
    $include .= $abs_path[$i] . "/";
}
include($include . "conexao.php");

$id_pedido = $_GET['id'];
$observacoes = $_GET['obs'];


$sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
    $consulta = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($consulta) == 0) {
    echo json_encode(array("status" => "falha", "causa" => "não encontrado"));

} else {

    $sql = "UPDATE pedidos SET observacoes='$observacoes' WHERE id_pedido=$id_pedido";
        mysqli_query($mysqli, $sql);

    echo json_encode(array("status"=>"sucesso"));
}