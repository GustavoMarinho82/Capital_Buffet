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
if(isset($_GET["querry"])){
    if($_GET["querry"] != ""){
    $querry = $_GET["querry"] ;
    $sql = "SELECT * FROM comidas WHERE
        nome_comida LIKE '%$querry%' OR
        preco_comida LIKE '%$querry%' OR
        estoque_comida LIKE '%$querry%' OR
        tipo LIKE '%$querry%'
    ";
    } if($_GET["querry"] != "" && $_GET["categoria"] != ""){
        $cat = $_GET["categoria"];
        $sql .= " OR categoria LIKE '%$cat%'";
    } else if ($_GET["categoria"] != ""){
        $cat = $_GET["categoria"];
        $sql = "SELECT * FROM comidas WHERE categoria LIKE '%$cat%'";
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
                "preco" => $linha['preco_comida'],
                "estoque" => $linha ['estoque_comida'],
                "tipo" => $linha['tipo'],
                "categoria" => $linha [ 'categoria'],
                "descricao" => $linha ['descricao_comida'],
                "img" => $linha ['url_imagem_c']
            );
            $x++;
    }
echo json_encode($return);