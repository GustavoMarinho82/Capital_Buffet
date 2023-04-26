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

            <form method="POST" action="criarPedido3.php">


            <!-- COMIDAS -->
            <h2>Comidas</h2>

                <?php 
                    $sql = "SELECT * FROM comidas WHERE estoque_comida>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    $id_esperado = 0;

                    while ($linha = mysqli_fetch_array($consulta)) {

                        while ($linha['id_comida'] != $id_esperado) {
                            
                            ?><input type="hidden" value ="0" name="qtd_comidas[<?php echo $id_esperado ?>]"><?php
                                $id_esperado++;
                        }     
                
                ?><!--Início do HTML-->

                        <hr>
                            <img src="<?php echo $linha['url_imagem_c'] ?>" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_comida'] ?></b> <br>
                            Preço por unidade: <b>R$ <?php echo $linha['preco_comida'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_comida'] ?></b> <br>
                            Tipo: <b><?php echo $linha['tipo']; ?></b> <br>
                            Categoria: <b><?php echo $linha['categoria']; ?></b> <br>
                            Descrição: <b><?php echo $linha['descricao_comida']; ?></b> <br>

                            Quantidade desejada: <input type="number" value ="0" min="0" max="<?php echo $linha['estoque_comida']; ?>" 
                                name="qtd_comidas[<?php $linha['id_comida'] ?>]">
                        <hr>

                <!--Fim do HTML--><?php
                        
                        $id_esperado = ($linha['id_comida']+1);
                    }
                ?>


            <!-- UTILITÁRIOS -->
            <br><h2>Utilitários</h2>

                <?php
                    $sql = "SELECT * FROM utilitarios WHERE estoque_utilitario>0";
                        $consulta = mysqli_query($mysqli, $sql);

                    $id_esperado = 0;

                    while ($linha = mysqli_fetch_array($consulta)) {

                        while ($linha['id_utilitario'] != $id_esperado) {
                            
                            ?><input type="hidden" value ="0" name="qtd_utilitarios[<?php echo $id_esperado ?>]"><?php
                                $id_esperado++;
                        }    

                ?><!--Início do HTML-->

                        <hr>
                            <img src="<?php echo $linha['url_imagem_u'] ?>" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_utilitario'] ?></b> <br>
                            Preço por unidade: <b>R$ <?php echo $linha['preco_utilitario'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_utilitario'] ?></b> <br>
                            Descrição: <b><?php echo $linha['descricao_utilitario']; ?></b> <br>
                                
                            Quantidade desejada: <input type="number" value ="0" min="0" max="<?php echo $linha['estoque_utilitario']; ?>" 
                                name="qtd_utilitarios[<?php $linha['id_utilitario'] ?>]">
                        <hr>
                        
                <!--Fim do HTML--><?php   

                        $id_esperado = ($linha['id_utilitario']+1);
                    }
                ?>


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
                ?>

                        <!--Início do HTML-->
                        <hr>
                            Chefes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[0] ?>" name="qtd_cargos[Chefe de cozinha]"> <br>
                            Ajudantes de cozinha: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[1] ?>" name="qtd_cargos[Ajudante de cozinha]"> <br>
                            Copeiros: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[2] ?>" name="qtd_cargos[Copeiro]"> <br>
                            Garçons: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[3] ?>" name="qtd_cargos[Garçom]"> <br>
                            Barmans: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[4] ?>" name="qtd_cargos[Barman]"> <br>
                            Recepcionistas: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[5] ?>" name="qtd_cargos[Recepcionista]"> <br>
                            Seguranças: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[6] ?>" name="qtd_cargos[Segurança]"> <br>
                            Faxineiros: <input type="number" value ="0" min="0" max="<?php echo $max_cargo[7] ?>" name="qtd_cargos[Faxineiro]"> <br>
                        <hr>


                <input type="submit" value="Ver o orçamento do pedido" />
            </form>
            
            <a href="criarPedido.php">Voltar</a>
    </BODY>
</HTML>