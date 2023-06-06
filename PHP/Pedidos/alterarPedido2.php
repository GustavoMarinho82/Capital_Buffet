<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Pedido</TITLE>
    </HEAD>

    <BODY>
        <?php
            require('../variaveis.php');
            include('../conexao.php');
            
            session_start();
                $id_pedido = $_SESSION['id_pedido'];

            $tipo = $_POST['tipo_evento'];
            $inicio_evento = $_POST['inicio_evento'];
            $fim_evento = $_POST['fim_evento'];
            $qtd_convidados = $_POST['qtd_convidados'];
            $endereco = $_POST['endereco'];
            $observacoes = $_POST['observacoes'];
            $status = $_POST['status'];

            //Não use \array_diff nesses array
            $qtd_comidas = $_POST['qtd_comidas'];
            $qtd_utilitarios = $_POST['qtd_utilitarios'];
            $qtd_cargos = $_POST['qtd_cargos'];

            $qtd_antiga_comidas = conseguir_qtd_antiga("comida");
            $qtd_antiga_utilitarios = conseguir_qtd_antiga("utilitario");
            $qtd_antiga_funcionarios = conseguir_qtd_antiga_funcionarios();

            $orcamento = conseguir_orcamento();

            
            $sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Pedido não encontrado!";
            
            } else {

                $coluna = mysqli_fetch_array($consulta);
                    if(empty($tipo))                    { $tipo = $coluna["tipo_evento"]; }
                    if(empty($status))                  { $status = $coluna["status_pedido"]; }
                    if(empty($inicio_evento))           { $inicio_evento = $coluna["inicio_evento"]; }
                    if(empty($fim_evento))              { $fim_evento = $coluna["fim_evento"]; }
                    if(empty($endereco))                { $endereco = $coluna["endereco"]; }
                    if(empty($observacoes))             { $observacoes = $coluna["observacoes"]; }
                    if(strlen($qtd_convidados) == 0)    { $qtd_convidados = $coluna["qtd_convidados"]; }

                $sql = "UPDATE pedidos SET tipo_evento='$tipo', orcamento=$orcamento, status_pedido='$status', inicio_evento='$inicio_evento', fim_evento='$fim_evento', qtd_convidados=$qtd_convidados, endereco='$endereco', observacoes='$observacoes' WHERE id_pedido=$id_pedido";
                    mysqli_query($mysqli, $sql);


                //PEDIDOS_COMIDAS
                foreach ($qtd_comidas as $id_comida => $qtd_comida) {
                    $qtd_antiga_comida = isset($qtd_antiga_comidas[$id_comida]) ? $qtd_antiga_comidas[$id_comida] : 0;

                    if ($qtd_antiga_comida != $qtd_comida) {
                        if ($qtd_comida == 0) {
                            $sql = "DELETE FROM pedido_comidas WHERE comida_id=$id_comida AND pedido_id=$id_pedido";
                                mysqli_query($mysqli, $sql);

                        } else if ($qtd_antiga_comida == 0){
                            $sql = "INSERT INTO pedido_comidas (pedido_id, comida_id, qtd_comida) VALUES ($id_pedido, $id_comida, $qtd_comida)";
                                mysqli_query($mysqli, $sql);

                        } else {
                            $sql = "UPDATE pedido_comidas SET qtd_comida=$qtd_comida WHERE comida_id=$id_comida AND pedido_id=$id_pedido";
                                mysqli_query($mysqli, $sql);
                        }
                    }
                }
                
                //PEDIDOS_UTILITÁRIOS
                foreach ($qtd_utilitarios as $id_utilitario => $qtd_utilitario) {
                    $qtd_antiga_utilitario = isset($qtd_antiga_utilitarios[$id_utilitario]) ? $qtd_antiga_utilitarios[$id_utilitario] : 0;
                    
                    if ($qtd_antiga_utilitario != $qtd_utilitario) {
                        if ($qtd_utilitario == 0) {
                            $sql = "DELETE FROM pedido_utilitarios WHERE utilitario_id=$id_utilitario AND pedido_id=$id_pedido";
                                mysqli_query($mysqli, $sql);

                        } else if ($qtd_antiga_utilitario == 0){
                            $sql = "INSERT INTO pedido_utilitarios (pedido_id, utilitario_id, qtd_utilitario) VALUES ($id_pedido, $id_utilitario, $qtd_utilitario)";
                                mysqli_query($mysqli, $sql);

                        } else {
                            $sql = "UPDATE pedido_utilitarios SET qtd_utilitario=$qtd_utilitario WHERE utilitario_id=$id_utilitario AND pedido_id=$id_pedido";
                                mysqli_query($mysqli, $sql);
                        }
                    }
                }

                //PEDIDOS_FUNCIONARIOS
                foreach ($qtd_cargos as $cargo => $qtd_cargo) {
                    $qtd_antiga_funcionario = $qtd_antiga_funcionarios[$cargo];

                    if ($qtd_antiga_funcionario != $qtd_cargo) {
                        if ($qtd_antiga_funcionario > $qtd_cargo) {
                            $diferenca = $qtd_antiga_funcionario - $qtd_cargo;

                            $sql = "DELETE FROM pedido_funcionarios WHERE funcionario_cpf IN (SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo') LIMIT $diferenca";
                                mysqli_query($mysqli, $sql);

                        } else {
                            $diferenca = $qtd_cargo - $qtd_antiga_funcionario; 

                            $sql = "SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo' AND cpf_funcionario NOT IN (SELECT funcionario_cpf FROM pedido_funcionarios) ORDER BY rand() LIMIT $diferenca";
                                $consulta = mysqli_query($mysqli, $sql);
                                
                            while ($cpf_funcionario = mysqli_fetch_column($consulta)) {
                                $sql = "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) VALUES ($id_pedido, '$cpf_funcionario')";
                                    mysqli_query($mysqli, $sql);
                            }
                        }
                    }
                }

                echo "Pedido alterado com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>

<?php
    //FUNÇÕES
    function conseguir_qtd_antiga($entidade) {
        global $mysqli, $id_pedido;

        $sql = "SELECT * FROM pedido_" . $entidade . "s WHERE pedido_id=$id_pedido";
            $consulta = mysqli_query($mysqli, $sql);

        $qtd_antiga = array();
        
        while($linha = mysqli_fetch_array($consulta)) {
            $qtd_antiga[$linha[$entidade . '_id']] = $linha['qtd_' . $entidade];
        }
        
        return $qtd_antiga;
    };

    function conseguir_qtd_antiga_funcionarios() {
        global $mysqli, $id_pedido, $cargos;
        $qtd_antiga = array();

        foreach($cargos as $cargo => $custo_hora) {
            $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf IN (SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo')";
                $consulta = mysqli_query($mysqli, $sql);
                    $qtd_antiga[$cargo] = mysqli_num_rows($consulta);
        }

        return $qtd_antiga;
    };

    function conseguir_orcamento() {
        global $mysqli, $inicio_evento, $fim_evento, $qtd_comidas, $qtd_utilitarios, $qtd_cargos, $cargos;
        $orcamento = 500;

        $sql = "SELECT * FROM comidas";
            $consulta = mysqli_query($mysqli, $sql);
                
        while ($linha = mysqli_fetch_array($consulta)) {
            $qtd_comida = $qtd_comidas[$linha['id_comida']];
                $orcamento+= ($qtd_comida*$linha['preco_comida']);
        }

        $sql = "SELECT * FROM utilitarios";
            $consulta = mysqli_query($mysqli, $sql);
                
        while ($linha = mysqli_fetch_array($consulta)) {
            $qtd_utilitario = $qtd_utilitarios[$linha['id_utilitario']];
                $orcamento+= ($qtd_utilitario*$linha['preco_utilitario']);
        }

        $duracao = date_diff(date_create($inicio_evento), date_create($fim_evento), true);
            $d = $duracao->format('%h');
        
            foreach ($cargos as $cargo => $custo_hora) { 
                $orcamento+= ($qtd_cargos[$cargo]*$custo_hora*$d);
            }

        return $orcamento;
    };
?>