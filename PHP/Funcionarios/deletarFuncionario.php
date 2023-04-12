<?php
include('../conexao.php');
$cpf = $_GET['cpf'];
$sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf'";
    $consulta = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($consulta) == 0) {
    echo json_encode(array( "status" => "falha", "causa" => "não encontrado"));
} else {
    $sql = "SELECT * FROM pedido_funcionarios WHERE funcionario_cpf='$cpf'";
        $consulta = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($consulta) != 0) {
        echo json_encode(array("status"=>"falha", "causa"=>"faz parte de pedido"));
    } else {
        $sql = "DELETE FROM funcionarios WHERE cpf_funcionario='$cpf'";
            mysqli_query($mysqli, $sql);
        echo json_encode(array( "status" => "sucesso"));
    }
}