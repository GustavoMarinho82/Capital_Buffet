<?php
$abs_path = explode("/",str_replace("\\", "/",__DIR__));
$max = sizeof($abs_path);
$max--;
$include = "";
for($i = 0; $i < $max; $i++)
{
$include .= $abs_path[$i] . "/";
}
include($include . "conexao.php");

$count = 0;
if(isset($_GET)){
    $sql = 'SELECT * FROM comidas';
    if(isset($_GET["nome"]) && $_GET["nome"] != ""){
        $sql .= ' WHERE nome_comida LIKE "%'.$_GET["nome"].'%"';
        $count++;
    }
    if(isset($_GET["categoria"]) && $_GET["categoria"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' categoria LIKE "%'.$_GET["categoria"].'%"';
    }
    if(isset($_GET["tipo"]) && $_GET["tipo"] != ""){
        if($count > 0){
            $sql .= "OR ";
        }else{
            $sql .= " WHERE ";
            $count++;
        }
         $sql .= ' tipo LIKE "%'.$_GET["tipo"].'%"';
    }
    if(isset($_GET["ordem"])){
        if($_GET["ordem"] == "+"){
            $sql .= " ORDER BY preco_comida DESC";
        }else if($_GET["ordem"] == "-"){   
            $sql .= " ORDER BY preco_comida ASC";
        }
    }
}else{
    $sql = 'SELECT * FROM comidas';
}
$consulta = mysqli_query($mysqli, $sql);
$reuturn = array();
$x = 0;
    while ($linha  = mysqli_fetch_array($consulta)) {
            $return[$x] = array(
                "id" => $linha ['id_comida'],
                "nome" => $linha["nome_comida"],
                "preco" => $linha['preco_comida'], "estoque" => $linha ['estoque_comida'],
                "tipo" => $linha['tipo'],
                "categoria" => $linha [ 'categoria'],
                "descricao" => $linha ['descricao_comida'],
                "img" => $linha ['url_imagem_c']
            );
            $x++;
    }
echo json_encode($return);