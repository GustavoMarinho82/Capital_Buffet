<?php 
    require('../variaveis.php');
    include('../conexao.php');

    session_start();
        //O \array_diff(array, [x]) remove os index's de um array que contenham valores iguais a x.
        $_SESSION['qtd_comidas'] = \array_diff($_POST['qtd_comidas'], [0]);
        $_SESSION['qtd_utilitarios'] = \array_diff($_POST['qtd_utilitarios'], [0]);
        
        $qtd_cargos = $_POST['qtd_cargos'];
        $_SESSION['qtd_cargos'] = \array_diff($_POST['qtd_cargos'], [0]);
?>

<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Sumário</TITLE>
    </HEAD>

    <BODY> 
        <h1>Sumário do Pedido</h1>

            Tipo do Evento: <?php echo $_SESSION['tipo_evento'] ?> <br>
            Início do Evento: <?php echo str_replace("T", " ", $_SESSION['inicio_evento']) ?> <br>
            Fim do Evento: <?php echo str_replace("T", " ", $_SESSION['fim_evento']) ?> <br>
            Quantidade de Convidados: <?php echo $_SESSION['qtd_convidados'] ?> <br>
            Endereço: <?php echo $_SESSION['endereco'] ?> <br>
            Observações: <?php echo $_SESSION['observacoes'] ?> <br><br>


            <h2>Comidas</h2>
                
                <?php 

                    $sql = "SELECT * FROM comidas WHERE estoque_comida>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    $qtd_comidas = $_POST['qtd_comidas'];
                    $custo_comidas = 0;
                    

                    while ($linha = mysqli_fetch_array($consulta)) {

                        $qtd_comida = $qtd_comidas[$linha['id_comida']];
                        $preco_total_comida = ($qtd_comida*$linha['preco_comida']);

                        if ($qtd_comida > 0) {

                            $custo_comidas+= $preco_total_comida;
                
                ?><!--Início do HTML-->

                            Nome: <?php echo $linha['nome_comida']?> <br>
                            Quantidade solicitada: <?php echo $qtd_comida?> <br>
                            Preço por unidade: R$ <?php echo $linha['preco_comida']?> <br>
                            Preço total: R$ <?php echo $preco_total_comida?> <br><br>

                <!--Fim do HTML--><?php

                        }
                    } 
                ?>

            <h2>Utilitários</h2>

                <?php    
                    $sql = "SELECT * FROM utilitarios WHERE estoque_utilitario>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    $qtd_utilitarios = $_POST['qtd_utilitarios'];
                    $custo_utilitarios = 0;
                    

                    while ($linha = mysqli_fetch_array($consulta)) {

                        $qtd_utilitario = $qtd_utilitarios[$linha['id_utilitario']];
                        $preco_total_utilitario = ($qtd_utilitario*$linha['preco_utilitario']);

                        if ($qtd_utilitario > 0) {

                            $custo_utilitarios+= $preco_total_utilitario;

                ?><!--Início do HTML-->

                            Nome: <?php echo $linha['nome_utilitario']?> <br>
                            Quantidade solicitada: <?php echo $qtd_utilitario?> <br>
                            Preço por unidade: R$ <?php echo $linha['preco_utilitario']?> <br>
                            Preço total: R$ <?php echo $preco_total_utilitario?> <br><br>
                
                <!--Fim do HTML--><?php

                        }
                    } 
                ?>

                <h2>Funcionário</h2>

                    Quantidade de Chefes: <b><?php echo $qtd_cargos["Chefe de cozinha"] ?></b> (R$50/h cada)<br>
                    Quantidade de Ajudantes de cozinha: <b><?php echo $qtd_cargos["Ajudante de cozinha"] ?></b> (R$35 cada)<br>
                    Quantidade de Copeiros: <b><?php echo $qtd_cargos["Copeiro"] ?></b> (R$15/h cada)<br>
                    Quantidade de Garçons: <b><?php echo $qtd_cargos["Garçom"] ?></b> (R$25/h cada)<br>
                    Quantidade de Barmans: <b><?php echo $qtd_cargos["Barman"] ?></b> (R$35/h cada)<br>
                    Quantidade de Recepcionistas: <b><?php echo $qtd_cargos["Recepcionista"] ?></b> (R$30/h cada)<br>
                    Quantidade de Seguranças: <b><?php echo $qtd_cargos["Segurança"] ?></b> (R$45/h cada)<br>
                    Quantidade de Faxineiros: <b><?php echo $qtd_cargos["Faxineiro"] ?></b> (R$20/h cada)<br>


                <h1>Orçamento</h1>

                    <?php
                        $d = $_SESSION['duracao'];
                        $custo_funcionarios = 0; 

                        foreach($cargos as $cargo => $custo_hora) {
                            $custo_funcionarios+= ($qtd_cargos[$cargo]*$custo_hora*$d);
                        }

                        $custo_total = ($custo_comidas + $custo_utilitarios + $custo_funcionarios + 500);
                            $_SESSION['custo_total'] = $custo_total;
                    ?>

                    Custo das Comidas: R$ <?php echo $custo_comidas ?> <br>
                    Custo dos Utilitários: R$ <?php echo $custo_utilitarios ?> <br>
                    Custo dos Funcionários: R$ <?php echo $custo_funcionarios ?> <br>
                    Custo Total: R$ <?php echo $custo_total ?> <br>

                    <h6>* - É adicionada uma taxa de R$ 500 sobre o custo total</h6>

            <button onclick="window.location.href='criarPedido4.php'">Finalizar pedido</button>
                <br><br>
            <a href="criarPedido2.php">Voltar</a>
    </BODY>
</HTML>