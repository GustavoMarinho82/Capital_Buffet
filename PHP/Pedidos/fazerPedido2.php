<?php 
    include('../conexao.php');
    
    session_start();
        $_SESSION['tipo_evento'] = $_POST['tipo_evento'];
        $_SESSION['inicio_evento'] = $_POST['inicio_evento'];
        $_SESSION['duracao'] = $_POST['duracao'];
        $_SESSION['qtd_convidados'] = $_POST['qtd_convidados'];
        $_SESSION['endereco'] = $_POST['endereco'];
        $_SESSION['observacoes'] = $_POST['observacoes'];

        $fim_e = strtotime($_POST['inicio_evento']) + 3600*(2+$_POST['duracao']);
            $_SESSION['fim_evento'] = gmdate("Y-m-d\TH:i", $fim_e);
?>

<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Escolher Componentes</TITLE>

        <style>
            hr { width:300px; text-align:left; margin-left:0 }
            .mostruario { max-width: 250px }
        </style>

    </HEAD>

    <BODY>
            
        <h1>Escolher os componentes do Buffet</h1>

            <form method="POST" action="fazerPedido3.php">

            <!--COMIDAS -->
            <h2>Comidas</h2>

                <?php 
                    $sql = "SELECT * FROM comidas WHERE estoque_comida>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    while ($linha = mysqli_fetch_array($consulta)) {
                ?>
                        <hr>

                            <img src="https://media.istockphoto.com/id/491520707/photo/sample-red-grunge-round-stamp-on-white-background.jpg?s=612x612&w=0&k=20&c=FW80kR5ilPkiJtXZEauGTghNBOgQviVPxAbhLWwnKZk=" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_comida'] ?></b> <br>
                            Preço: <b>R$ <?php echo $linha['preco_comida'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_comida'] ?></b> <br>
                            Tipo: <b><?php echo $linha['tipo']; ?></b> <br>
                            Categoria: <b><?php echo $linha['categoria']; ?></b> <br>
                            Descrição: <b><?php echo $linha['descricao_comida']; ?></b> <br>
                            
                            Quantidade desejada: <input type="number" value ="0" min="0" max="<?php echo $linha['estoque_comida']; ?>" 
                                name="qtd_comidas[<?php $linha['id_comida'] ?>]">

                        <hr>
                <?php } ?>


            <!-- PRODUTOS -->
            <br><h2>Utilitários</h2>

                <?php
                    $sql = "SELECT * FROM produtos WHERE estoque_produto>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    while ($linha = mysqli_fetch_array($consulta)) {
                ?>
                        <hr>

                            <img src="https://media.istockphoto.com/id/491520707/photo/sample-red-grunge-round-stamp-on-white-background.jpg?s=612x612&w=0&k=20&c=FW80kR5ilPkiJtXZEauGTghNBOgQviVPxAbhLWwnKZk=" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_produto'] ?></b> <br>
                            Preço: <b>R$ <?php echo $linha['preco_produto'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_produto'] ?></b> <br>
                            Descrição: <b><?php echo $linha['descricao_produto']; ?></b> <br>
                            
                            Quantidade desejada: <input type="number" value ="0" min="0" max="<?php echo $linha['estoque_produto']; ?>" 
                                name="qtd_produtos[<?php $linha['id_produto'] ?>]">

                        <hr>
                <?php } ?>


            <!-- FUNCIONÁRIOS -->
            <br><h2>Funcionários</h2>

                <?php
                    $sql = "SELECT * FROM funcionarios WHERE cargo='Chefe de cozinha'";
                        $max_chefe = mysqli_num_rows(mysqli_query($mysqli, $sql));

                    $sql = "SELECT * FROM funcionarios WHERE cargo='Copeiro'";
                        $max_copeiro = mysqli_num_rows(mysqli_query($mysqli, $sql));

                    $sql = "SELECT * FROM funcionarios WHERE cargo='Garçom'";
                        $max_garcom = mysqli_num_rows(mysqli_query($mysqli, $sql));

                    $sql = "SELECT * FROM funcionarios WHERE cargo='Barman'";
                        $max_barman = mysqli_num_rows(mysqli_query($mysqli, $sql));

                    $sql = "SELECT * FROM funcionarios WHERE cargo='Ajudante de cozinha'";
                        $max_ajudante = mysqli_num_rows(mysqli_query($mysqli, $sql));
                ?>

                        <hr>

                            Chefes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_chefe ?>" name="qtd_chefe"> <br>
                            Copeiros: <input type="number" value ="0" min="0" max="<?php echo $max_copeiro ?>" name="qtd_copeiro"> <br>
                            Garçons: <input type="number" value ="0" min="0" max="<?php echo $max_garcom ?>" name="qtd_garcom"> <br>
                            Barmans: <input type="number" value ="0" min="0" max="<?php echo $max_barman ?>" name="qtd_barman"> <br>
                            Ajudantes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_ajudante ?>" name="qtd_ajudante"> <br>

                        <hr>


                <input type="hidden" value="">

                <input type="submit" value="Ver o orçamento do pedido" />
            </form>
            
            <a href="fazerPedido.php">Voltar</a>
    </BODY>
</HTML>