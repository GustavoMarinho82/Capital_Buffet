<?php
include('../conexao.php');
$id_usuario = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
    $consulta = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($consulta) == 0) {
    echo json_encode(array("status"=>"falha","causa"=>"não encontrado"));
} else {
    $sql = "SELECT * FROM pedidos WHERE usuario_id='$id_usuario'";
        $consulta = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($consulta) != 0) {
        echo json_encode(array("status"=>"falha","causa"=>"pedidos ainda ativos"));
    } else {
        $sql = "DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
            mysqli_query($mysqli, $sql);
        echo json_encode(array("status"=>"sucesso"));
    }
}