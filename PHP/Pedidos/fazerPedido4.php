<?php 
    include('../conexao.php');

    date_default_timezone_set('America/Sao_Paulo');
    session_start();
?>

<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Finalizar Pedido</TITLE>
    </HEAD>

    <BODY>

        <?php 
            $tipo = $_SESSION['tipo_evento'];
            $orcamento = $_SESSION['custo_total'];
            $data_pedido = date("Y-m-d\TH:i", time());
            $inicio_evento = $_SESSION['inicio_evento'];
            $fim_evento = $_SESSION['fim_evento'];
            $qtd_convidados = $_SESSION['qtd_convidados'];
            $endereco = $_SESSION['endereco'];
            $observacoes = $_SESSION['observacoes'];

            $qtd_comidas = $_SESSION['qtd_comidas'];
            $qtd_produtos = $_SESSION['qtd_produtos'];

            $cargos = $_SESSION['cargos'];
            $qtd_cargos = $_SESSION['qtd_cargos'];

            //Id do usuario setado como 1 só para testar
            $usuario_id = 1;

            echo $data_pedido;
            //PEDIDOS
            $sql = "INSERT INTO pedidos (tipo_evento, orcamento, data_pedido, inicio_evento, fim_evento , qtd_convidados, endereco, observacoes, usuario_id) VALUES 
                ('$tipo', $orcamento, '$data_pedido', '$inicio_evento', '$fim_evento', $qtd_convidados, '$endereco', '$observacoes', $usuario_id)";
                    mysqli_query($mysqli, $sql);

                        $ultimo_id = mysqli_insert_id($mysqli);

            //PEDIDOS_COMIDAS
            $id_comida = 1;

                foreach($_SESSION['qtd_comidas'] as $qtd_comida) {

                    if ($qtd_comida != 0) {
                        $sql = "INSERT INTO pedido_comidas (pedido_id, comida_id, qtd_comida) VALUES ($ultimo_id, $id_comida, $qtd_comida)";
                            mysqli_query($mysqli, $sql);
                    }
                    $id_comida++;
                }

            //PEDIDOS_PRODUTOS
            $id_produto = 1;

                foreach($_SESSION['qtd_produtos'] as $qtd_produto) {

                    if ($qtd_produto != 0) {
                        $sql = "INSERT INTO pedido_produtos (pedido_id, produto_id, qtd_produto) VALUES ($ultimo_id, $id_produto, $qtd_produto)";
                            mysqli_query($mysqli, $sql);
                    }
                    $id_produto++;
                }


            //PEDIDOS_FUNCIONARIOS
            
                //$cargos = array("Chefe de cozinha", "Ajudante de cozinha", "Copeiro", "Garçom", "Barman", "Recepcionista", "Segurança", "Faxineiro");
                    
            $sql = "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) SELECT $ultimo_id, cpf_funcionario FROM funcionarios WHERE cargo=? ORDER BY rand() LIMIT ?";
                $stmt = mysqli_prepare($mysqli, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $cargo, $qtd_cargo);

                            
            for($x = 0; $x < count($cargos); $x++) {
                $cargo = $cargos[$x];
                $qtd_cargo = $qtd_cargos[$x];
                        
                    mysqli_stmt_execute($stmt);
            }
        ?>

            Pedido registrado com sucesso! <br>
            <a href="../index.html">Voltar</a>
    </BODY>
</HTML>