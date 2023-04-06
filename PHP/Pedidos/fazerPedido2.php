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

/*   TESTANDO ESSA SOLUÇÃO 
                    $sql = "SELECT * FROM comidas WHERE id_comida=?";
                        $stmt = mysqli_prepare($mysqli, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $x);

                    $x = 0;
                    while ($y<mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM comidas"))) {


                        $resultado = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($resultado) = 1) {
                            //código html
                            $y++

                        } else {
                            
                        }

                        $x++
                    } */

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
                    $cargos = array("Chefe de cozinha", "Ajudante de cozinha", "Copeiro", "Garçom", "Barman", "Recepcionista", "Segurança", "Faxineiro");
                    
                    $sql = "SELECT * FROM funcionarios WHERE cargo=?";
                        $stmt = mysqli_prepare($mysqli, $sql);
                            mysqli_stmt_bind_param($stmt, "s", $cargo);

                            
                    for($x = 0; $x < count($cargos); $x++) {
                        $cargo = $cargos[$x];
                        
                        $consulta = mysqli_stmt_execute($stmt); //Essa consulta foi utilizada para evitar um erro de sincronização
                        $resultado = mysqli_stmt_get_result($stmt);
                            $max_cargo[$x] = mysqli_num_rows($resultado);
                    }

                    $_SESSION['cargos'] = $cargos;
                ?>

                        <hr>

                            Chefes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[0] ?>" name="qtd_cargos[0]"> <br>
                            Ajudantes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[1] ?>" name="qtd_cargos[1]"> <br>
                            Copeiros: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[2] ?>" name="qtd_cargos[2]"> <br>
                            Garçons: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[3] ?>" name="qtd_cargos[3]"> <br>
                            Barmans: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[4] ?>" name="qtd_cargos[4]"> <br>
                            Recepcionistas: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[5] ?>" name="qtd_cargos[5]"> <br>
                            Seguranças: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[6] ?>" name="qtd_cargos[6]"> <br>
                            Faxineiros: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[7] ?>" name="qtd_cargos[7]"> <br>

                        <hr>


                <input type="hidden" value="">

                <input type="submit" value="Ver o orçamento do pedido" />
            </form>
            
            <a href="fazerPedido.php">Voltar</a>
    </BODY>
</HTML>