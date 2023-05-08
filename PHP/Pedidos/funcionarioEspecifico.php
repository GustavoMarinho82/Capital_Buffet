<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Funcionário Específico</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_pedido = $_POST['id_pedido'];
            $cpf_funcionario = $_POST['cpf_funcionario'];
            $acao = $_POST['acao'];

            $orcamento_anterior = orcamento_sem_funcionarios($mysqli, $id_pedido);


            $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf='$cpf_funcionario'";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Funcionário não encontrado no pedido!";
                
            } else {
                if ($acao == "Adicionar") {
                    $sql = "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) VALUES ($id_pedido, '$cpf_funcionario')";
                        mysqli_query($mysqli, $sql);

                } else {
                    $sql = "DELETE FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf='$cpf_funcionario";
                        mysqli_query($mysqli, $sql);
                }

                recalcular_orcamento($mysqli, $id_pedido, $orcamento_anterior);

                echo "Ação realizada com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>

<?php
    function orcamento_sem_funcionarios($mysqli, $id_pedido) {
        $sql = "SELECT orcamento, inicio_evento, fim_evento FROM pedidos WHERE pedido_id=$id_pedido";
            $consulta = mysqli_query($mysqli, $sql);
                $orcamento = mysqli_fetch_row($consulta)[0];
                $inicio_evento = mysqli_fetch_row($consulta)[1];
                $fim_evento = mysqli_fetch_row($consulta)[2];
            
        $duracao = date_diff(date_create($inicio_evento), date_create($fim_evento), true);
            $d = $duracao->format('%h');

        $cargos = array("Chefe de cozinha" => 50 , "Ajudante de cozinha" => 35, "Copeiro" => 15, "Garçom" => 25, "Barman" => 35, "Recepcionista" => 30, "Segurança" => 45, "Faxineiro" => 20);
    
        foreach ($cargos as $cargo => $custo_hora) {
            $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf IN (SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo')";
                mysqli_query($mysqli, $sql);
                    $qtd_cargo = mysqli_num_rows($consulta);

            $orcamento-= ($qtd_cargo*$custo_hora*$d);
        }

        return $orcamento;
    }

    function recalcular_orcamento($mysqli, $id_pedido, $orcamento) {
        $sql = "SELECT inicio_evento, fim_evento FROM pedidos WHERE pedido_id=$id_pedido";
            $consulta = mysqli_query($mysqli, $sql);
                $inicio_evento = mysqli_fetch_row($consulta)[0];
                $fim_evento = mysqli_fetch_row($consulta)[1];

        $duracao = date_diff(date_create($inicio_evento), date_create($fim_evento), true);
            $d = $duracao->format('%h');

        $cargos = array("Chefe de cozinha" => 50 , "Ajudante de cozinha" => 35, "Copeiro" => 15, "Garçom" => 25, "Barman" => 35, "Recepcionista" => 30, "Segurança" => 45, "Faxineiro" => 20);
        
        foreach ($cargos as $cargo => $custo_hora) {
            $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf IN (SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo')";
                mysqli_query($mysqli, $sql);
                    $qtd_cargo = mysqli_num_rows($consulta);

            $orcamento+= ($qtd_cargo*$custo_hora*$d);
        }

        $sql = "UPDATE pedidos SET orcamento=$orcamento WHERE id_pedido=$id_pedido";
            mysqli_query($mysqli, $sql);
    }
?>