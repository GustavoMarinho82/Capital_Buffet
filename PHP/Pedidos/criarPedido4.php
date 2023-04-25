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
        $qtd_utilitarios = $_SESSION['qtd_utilitarios'];
        $qtd_cargos = $_SESSION['qtd_cargos'];

    //Id do usuario setado como 1 só para testar
    $usuario_id = 1;


    //PEDIDOS
    $sql = "INSERT INTO pedidos (tipo_evento, orcamento, inicio_evento, fim_evento , qtd_convidados, endereco, observacoes, usuario_id) VALUES 
        ('$tipo', $orcamento, '$inicio_evento', '$fim_evento', $qtd_convidados, '$endereco', '$observacoes', $usuario_id)";
            mysqli_query($mysqli, $sql);

                $ultimo_id = mysqli_insert_id($mysqli);


    //PEDIDOS_COMIDAS
    foreach($qtd_comidas as $id_comida => $qtd_comida) {
        $sql = "INSERT INTO pedido_comidas (pedido_id, comida_id, qtd_comida) VALUES ($ultimo_id, $id_comida, $qtd_comida)";
            mysqli_query($mysqli, $sql);
    }


    //PEDIDOS_UTILITÁrios
    foreach($qtd_utilitarios as $id_utilitario => $qtd_utilitario) {
        $sql = "INSERT INTO pedido_utilitarios (pedido_id, utilitario_id, qtd_utilitario) VALUES ($ultimo_id, $id_utilitario, $qtd_utilitario)";
            mysqli_query($mysqli, $sql);
    }


    //PEDIDOS_FUNCIONARIOS
    $sql = "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) SELECT $ultimo_id, cpf_funcionario FROM funcionarios WHERE cargo=? ORDER BY rand() LIMIT ?";
        $stmt = mysqli_prepare($mysqli, $sql);
            mysqli_stmt_bind_param($stmt, "si", $cargo, $qtd_cargo);
          
    foreach($qtd_cargos as $cargo => $qtd_cargo) {
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
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>