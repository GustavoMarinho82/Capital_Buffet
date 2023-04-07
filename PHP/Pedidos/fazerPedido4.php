<?php
    include('../conexao.php');
            
    session_start();
        $tipo = $_SESSION['tipo_evento'];
        $orcamento = $_SESSION['custo_total'];
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
    $id_produto = 0; 

        foreach($qtd_produtos as $qtd_produto) {

            if ($qtd_produto > 0) {
                $sql = "INSERT INTO pedido_produtos (pedido_id, produto_id, qtd_produto) VALUES ($ultimo_id, $id_produto, $qtd_produto)";
                    mysqli_query($mysqli, $sql);
            }
            $id_produto++;
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
?>

<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Finalizar Pedido</TITLE>
    </HEAD>

    <BODY>
        Pedido registrado com sucesso! <br>
        
        <a href="../index.html">Voltar</a>
    </BODY>
</HTML>