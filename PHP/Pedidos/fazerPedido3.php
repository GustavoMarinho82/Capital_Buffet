<?php 
    include('../conexao.php');

    session_start();
        $_SESSION['qtd_comidas'] = $_POST['qtd_comidas'];
        $_SESSION['qtd_produtos'] = $_POST['qtd_produtos'];
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
                    $custo_comidas = 0;
                    $id_comida = 1;
                    
                    foreach($_POST['qtd_comidas'] as $qtd_comida) {
                        
                        if ($qtd_comida != 0) {

                            $sql= "SELECT * FROM comidas WHERE id_comida=$id_comida";
                                $consulta = mysqli_query($mysqli, $sql);
                                    $linha = mysqli_fetch_array($consulta);

                            ?>
                            
                            Nome: <?php echo $linha['nome_comida']?> <br>
                            Quantidade pedida: <?php echo $qtd_comida?> <br>
                            Preço por unidade: R$ <?php echo $linha['preco_comida']?> <br>
                            Preço total: R$ <?php echo $qtd_comida*$linha['preco_comida']?> <br><br>
                            
                            <?php
                            
                            $custo_comidas+= ($qtd_comida*$linha['preco_comida']);
                        }

                        $id_comida++;
                    } 
                ?>

            <h2>Utilitários</h2>

                <?php 
                    $custo_produtos = 0;
                    $id_produto = 1;
                    
                    foreach($_POST['qtd_produtos'] as $qtd_produto) {
                        
                        if ($qtd_produto != 0) {

                            $sql= "SELECT * FROM produtos WHERE id_produto=$id_produto";
                                $consulta = mysqli_query($mysqli, $sql);
                                    $linha = mysqli_fetch_array($consulta);

                            ?>
                            
                            Nome: <?php echo $linha['nome_produto']?> <br>
                            Quantidade pedida: <?php echo $qtd_produto?> <br>
                            Preço por unidade: R$ <?php echo $linha['preco_produto']?> <br>
                            Preço total: R$ <?php echo $qtd_produto*$linha['preco_produto']?> <br><br>
                            
                            <?php
                            
                            $custo_produtos+= ($qtd_produto*$linha['preco_produto']);
                        }

                        $id_produto++;
                    } 
                ?>

                <h2>Funcionário</h2>

                    <?php 
                        $qtd_chefe = $_POST['qtd_chefe'];
                        $qtd_copeiro = $_POST['qtd_copeiro'];
                        $qtd_garcom = $_POST['qtd_garcom'];
                        $qtd_barman = $_POST['qtd_barman'];
                        $qtd_ajudante = $_POST['qtd_ajudante'];
                    ?>

                    Quantidade de Chefes: <b><?php echo $qtd_chefe ?></b> (R$50/h cada)<br>
                    Quantidade de Copeiros: <b><?php echo $qtd_copeiro ?></b> (R$15/h cada)<br>
                    Quantidade de Garçons: <b><?php echo $qtd_garcom ?></b> (R$25/h cada)<br>
                    Quantidade de Barmans: <b><?php echo $qtd_barman ?></b> (R$35/h cada)<br>
                    Quantidade de Ajudantes de cozinha: <b><?php echo $qtd_ajudante ?></b> (R$35 cada)<br><br>


                <h1>Orçamento</h1>

                    <?php

                        $d = $_SESSION['duracao'];

                        $custo_funcionarios = (($qtd_chefe*50*$d) + ($qtd_copeiro*15*$d) + ($qtd_garcom*25*$d) + ($qtd_barman*35*$d) + ($qtd_ajudante*35*$d));
                        $custo_total = ($custo_comidas + $custo_produtos + $custo_funcionarios + 500);
                            $_SESSION['custo_total'] = $custo_total;           
                    ?>

                    Custo das Comidas: R$ <?php echo $custo_comidas ?> <br>
                    Custo dos Utilitários: R$ <?php echo $custo_produtos ?> <br>
                    Custo dos Funcionários: R$ <?php echo $custo_funcionarios ?> <br>
                    Custo Total: R$ <?php echo $custo_total ?> <br><br><br>



            <button onclick="window.location.href='fazerPedido4.php'">Finalizar pedido</button>
                <br><br>
            <a href="fazerPedido2.php">Voltar</a>
    </BODY>
</HTML>