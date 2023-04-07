<?php 
    include('../conexao.php');

    session_start();
        $_SESSION['qtd_comidas'] = $_POST['qtd_comidas'];
        $_SESSION['qtd_produtos'] = $_POST['qtd_produtos'];
        
        $qtd_cargos = $_POST['qtd_cargos'];
            $_SESSION['qtd_cargos'] = $qtd_cargos;
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
                    $sql = "SELECT * FROM produtos WHERE estoque_produto>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    $qtd_produtos = $_POST['qtd_produtos'];
                    $custo_produtos = 0;
                    

                    while ($linha = mysqli_fetch_array($consulta)) {

                        $qtd_produto = $qtd_produtos[$linha['id_produto']];
                        $preco_total_produto = ($qtd_produto*$linha['preco_produto']);

                        if ($qtd_produto > 0) {

                            $custo_produtos+= $preco_total_produto;

                ?><!--Início do HTML-->

                            Nome: <?php echo $linha['nome_produto']?> <br>
                            Quantidade solicitada: <?php echo $qtd_produto?> <br>
                            Preço por unidade: R$ <?php echo $linha['preco_produto']?> <br>
                            Preço total: R$ <?php echo $preco_total_produto?> <br><br>
                
                <!--Fim do HTML--><?php

                        }
                    } 
                ?>

                <h2>Funcionário</h2>

                    Quantidade de Chefes: <b><?php echo $qtd_cargos[0] ?></b> (R$50/h cada)<br>
                    Quantidade de Ajudantes de cozinha: <b><?php echo $qtd_cargos[1] ?></b> (R$35 cada)<br>
                    Quantidade de Copeiros: <b><?php echo $qtd_cargos[2] ?></b> (R$15/h cada)<br>
                    Quantidade de Garçons: <b><?php echo $qtd_cargos[3] ?></b> (R$25/h cada)<br>
                    Quantidade de Barmans: <b><?php echo $qtd_cargos[4] ?></b> (R$35/h cada)<br>
                    Quantidade de Recepcionistas: <b><?php echo $qtd_cargos[5] ?></b> (R$30/h cada)<br>
                    Quantidade de Seguranças: <b><?php echo $qtd_cargos[6] ?></b> (R$45/h cada)<br>
                    Quantidade de Faxineiros: <b><?php echo $qtd_cargos[7] ?></b> (R$20/h cada)<br>


                <h1>Orçamento</h1>

                    <?php
                        $d = $_SESSION['duracao'];

                        $custo_funcionarios = (($qtd_cargos[0]*50*$d) + ($qtd_cargos[1]*35*$d) + ($qtd_cargos[2]*15*$d) + ($qtd_cargos[3]*25*$d) + 
                            ($qtd_cargos[4]*35*$d) + ($qtd_cargos[5]*30*$d) + ($qtd_cargos[6]*45*$d) + ($qtd_cargos[7]*20*$d));

                        $custo_total = ($custo_comidas + $custo_produtos + $custo_funcionarios + 500);
                            $_SESSION['custo_total'] = $custo_total;           
                    ?>

                    Custo das Comidas: R$ <?php echo $custo_comidas ?> <br>
                    Custo dos Utilitários: R$ <?php echo $custo_produtos ?> <br>
                    Custo dos Funcionários: R$ <?php echo $custo_funcionarios ?> <br>
                    Custo Total: R$ <?php echo $custo_total ?> <br>

                    <h6>* - É adicionada uma taxa de R$ 500 sobre o custo total</h6>

            <button onclick="window.location.href='fazerPedido4.php'">Finalizar pedido</button>
                <br><br>
            <a href="fazerPedido2.php">Voltar</a>
    </BODY>
</HTML>