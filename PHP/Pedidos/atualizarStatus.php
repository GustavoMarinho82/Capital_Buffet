<?php
include('../conexao.php');
$id_pedido = $_GET['id'];
$status = $_GET['status'];
$sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
    $consulta = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($consulta) == 0) {
    echo json_encode(array("status"=>"falha","causa"=>"não encontrado"));
} else {
    $sql = "UPDATE pedidos SET status_pedido='$status' WHERE id_pedido=$id_pedido";
        mysqli_query($mysqli, $sql);
    echo json_encode(array("status"=>"sucesso"));
}
