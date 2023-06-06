<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Funcionário Específico</TITLE>
    </HEAD>

    <BODY>
        <?php
            require('../variaveis.php');
            include('../conexao.php');

            $id_pedido = $_POST['id_pedido'];
            $cpf_funcionario = $_POST['cpf_funcionario'];
            $acao = $_POST['acao'];


            $sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Pedido não encontrado!";

            } else {
                $sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf_funcionario'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "Funcionário não encontrado!";

                } else {
                    $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf='$cpf_funcionario'";
                        $consulta = mysqli_query($mysqli, $sql);

                    if (($acao == "Adicionar") && (mysqli_num_rows($consulta) != 0)) {
                        echo "O funcionário já faz parte desse pedido!";

                    } else if (($acao == "Remover") && (mysqli_num_rows($consulta) == 0)) {
                        echo "O funcionário não foi encontrado nesse pedido!";

                    } else {
                        $sql = ($acao == "Adicionar") 
                            ? "INSERT INTO pedido_funcionarios (pedido_id, funcionario_cpf) VALUES ($id_pedido, '$cpf_funcionario')" 
                            : "DELETE FROM pedido_funcionarios WHERE pedido_id=$id_pedido AND funcionario_cpf='$cpf_funcionario'";

                        mysqli_query($mysqli, $sql);

                        recalcular_orcamento();

                        echo "Ação realizada com sucesso!";
                    }
                }
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>

<?php 
    function recalcular_orcamento() {
        global $cargos, $mysqli, $id_pedido, $cpf_funcionario, $acao;
        
        $sql = "SELECT orcamento, inicio_evento, fim_evento FROM pedidos WHERE id_pedido=$id_pedido";
            $consulta = mysqli_query($mysqli, $sql);
                $linha = mysqli_fetch_assoc($consulta);
                    $orcamento = $linha['orcamento'];
                    $inicio_evento = $linha['inicio_evento'];
                    $fim_evento = $linha['fim_evento'];

        $duracao = date_diff(date_create($inicio_evento), date_create($fim_evento), true);
            $d = $duracao->format('%h');
        
        $sql = "SELECT cargo FROM funcionarios WHERE cpf_funcionario='$cpf_funcionario'";
            $consulta = mysqli_query($mysqli, $sql);  
                $custo_hora = $cargos[mysqli_fetch_row($consulta)[0]];

        ($acao == "Adicionar")
            ? $orcamento+= ($custo_hora*$d)
            : $orcamento-= ($custo_hora*$d);

        $sql = "UPDATE pedidos SET orcamento=$orcamento WHERE id_pedido=$id_pedido";
            mysqli_query($mysqli, $sql);
    }
?>