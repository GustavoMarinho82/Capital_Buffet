<?php
include "../conexao.php";
$count = 0;
if(isset($_GET)){
    $sql = 'SELECT * FROM funcionarios';
    if(isset($_GET["nome"]) && $_GET["nome"] != ""){
        $sql .= ' WHERE nome_funcionario LIKE "%'.$_GET["nome"].'%"';
        $count++;
    }
    if(isset($_GET["cpf"]) && $_GET["cpf"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' cpf_funcionario LIKE "%'.$_GET["cpf"].'%"';
    }
    if(isset($_GET["cargo"]) && $_GET["cargo"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' cargo LIKE "%'.$_GET["cargo"].'%"';
    }
    if(isset($_GET["email"]) && $_GET["email"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' email_funcionario LIKE "%'.$_GET["email"].'%"';
    }
    if(isset($_GET["telefone"]) && $_GET["telefone"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' telefone_funcionario LIKE "%'.$_GET["telefone"].'%"';
    }
    if(isset($_GET["ordem"])){
        if($_GET["ordem"] == "+"){
            $sql .= " ORDER BY salario DESC";
        }else if($_GET["ordem"] == "-"){   
            $sql .= " ORDER BY salario ASC";
        }
    }
}else{
    $sql = 'SELECT * FROM funcionarios';
}
$consulta = mysqli_query($mysqli, $sql);
$return = array();
$x = 0;
while ($linha = mysqli_fetch_array($consulta)) {
    $cpf= $linha["cpf_funcionario"];
    $n= $linha["nome_funcionario"];
    $car= $linha["cargo"];
    $s= $linha["salario"];
    $e= $linha["email_funcionario"];
    $t= $linha["telefone_funcionario"];
        $return[$x] = array(
            "cpf" => $cpf,
            "nome" => $n,
            "cargo" => $car,
            "salario" => $s,
            "email" => $e,
            "telefone" => $t
        );
    $x++;
}
echo json_encode($return);