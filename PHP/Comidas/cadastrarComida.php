<?php

include('../conexao.php');

$nome = $_GET['name'];
$preco = str_replace(",", ".", $_GET['price']);
$estoque = $_GET['stock'];
$tipo = $_GET['type'];
$categoria = $_GET['category'];
$descricao = $_GET['desc'];


$sql = "INSERT INTO comidas (nome_comida, preco_comida, estoque_comida, tipo, categoria, descricao_comida) VALUES ('$nome', $preco, $estoque, '$tipo', '$categoria', '$descricao')";

mysqli_query($mysqli, $sql);