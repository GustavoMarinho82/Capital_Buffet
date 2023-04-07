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

            //Id do usuario setado como 1 só para testar
            $usuario_id = 1;

            echo $data_pedido;
            $sql = "INSERT INTO pedidos (tipo_evento, orcamento, data_pedido, inicio_evento, fim_evento , qtd_convidados, endereco, observacoes, usuario_id) VALUES 
                ('$tipo', $orcamento, '$data_pedido', '$inicio_evento', '$fim_evento', $qtd_convidados, '$endereco', '$observacoes', $usuario_id)";
                    mysqli_query($mysqli, $sql);

                        $ultimo_id = mysqli_insert_id($mysqli);

            
            $id_comida = 1;

            foreach($_SESSION['qtd_comidas'] as $qtd_comida) {

                if ($qtd_comida != 0) {

                    $sql = "INSERT INTO pedido_comidas (pedido_id, comida_id, qtd_comida) VALUES ($ultimo_id, $id_comida, $qtd_comida)";
                        mysqli_query($mysqli, $sql);

                    $sql = "UPDATE comidas SET estoque_comida = (estoque_comida - $qtd_comida) WHERE id_comida=$id_comida";
                        mysqli_query($mysqli, $sql);
                }

                $id_comida++;
            }


            $id_produto = 1;

            foreach($_SESSION['qtd_produtos'] as $qtd_produto) {

                if ($qtd_produto != 0) {

                    $sql = "INSERT INTO pedido_produtos (pedido_id, produto_id, qtd_produto) VALUES ($ultimo_id, $id_produto, $qtd_produto)";
                        mysqli_query($mysqli, $sql);

                    $sql = "UPDATE produtos SET estoque_produto = (estoque_produto - $qtd_produto) WHERE id_produto=$id_produto";
                        mysqli_query($mysqli, $sql);
                }

                $id_produto++;
            }
        ?>

        
    </BODY>
</HTML>