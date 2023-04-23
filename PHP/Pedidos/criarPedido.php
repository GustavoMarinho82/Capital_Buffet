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
include($include . "CORS.php");
cors();

    $tipo = $_GET['tipo_evento'];
    $orcamento = $_GET['custo_total'];
    $inicio_evento = $_GET['inicio_evento'];
    $fim_evento = $_GET['fim_evento'];
    $qtd_convidados = $_GET['qtd_convidados'];
    $endereco = $_GET['endereco'];
    $observacoes = $_GET['observacoes'];

    $qtd_comidas = $_GET['qtd_comidas'];
    $qtd_utilitarios = $_GET['qtd_utilitarios'];

    $cargos = array("Chefe de cozinha", "Ajudante de cozinha", "Copeiro", "Garçom", "Barman", "Recepcionista", "Segurança", "Faxineiro");
    $qtd_cargos = $_GET['qtd_cargos'];

    $usuario_id = $_GET["id_usuario"];


    //PEDIDOS
    $sql = "INSERT INTO pedidos (tipo_evento, orcamento, inicio_evento, fim_evento , qtd_convidados, endereco, observacoes, usuario_id) VALUES 
        ('$tipo', $orcamento, '$inicio_evento', '$fim_evento', $qtd_convidados, '$endereco', '$observacoes', $usuario_id)";
            mysqli_query($mysqli, $sql);

                $ultimo_id = mysqli_insert_id($mysqli);


    //PEDIDOS_COMIDAS
    $id_comida = 0; //Tem que começar por 0 porque os arrays das quantidades começam com 0 (que não referencia nenhum id)

        foreach($qtd_comidas as $qtd_comida) {

            if ($qtd_comida > 0) {
                $sql = "INSERT INTO pedido_comidas (pedido_id, comida_id, qtd_comida) VALUES ($ultimo_id, $id_comida, $qtd_comida)";
                    mysqli_query($mysqli, $sql);
            }
            $id_comida++;
        }


    //PEDIDOS_PRODUTOS
    $id_utilitario = 0; 

        foreach($qtd_utilitarios as $qtd_utilitario) {

            if ($qtd_utilitario > 0) {
                $sql = "INSERT INTO pedido_utilitarios (pedido_id, utilitario_id, qtd_utilitario) VALUES ($ultimo_id, $id_utilitario, $qtd_utilitario)";
                    mysqli_query($mysqli, $sql);
            }
            $id_utilitario++;
        }


    //PEDIDOS_FUNCIONARIOS
            
        //Ordem do array cargos -> ("Chefe de cozinha", "Ajudante de cozinha", "Copeiro", "Garçom", "Barman", "Recepcionista", "Segurança", "Faxineiro")
                    
    $sql = "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) SELECT $ultimo_id, cpf_funcionario FROM funcionarios WHERE cargo=? ORDER BY rand() LIMIT ?";
        $stmt = mysqli_prepare($mysqli, $sql);
            mysqli_stmt_bind_param($stmt, "si", $cargo, $qtd_cargo);

                            
    for($x = 0; $x < count($cargos); $x++) {
        $cargo = $cargos[$x];
        $qtd_cargo = $qtd_cargos[$x];
                        
            mysqli_stmt_execute($stmt);
    }

echo json_encode(array("status"=>"sucesso"));