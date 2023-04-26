<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Pedido</TITLE>

        <style>
            hr { width:300px; text-align:left; margin-left:0 }
            .mostruario { max-width: 250px }
        </style>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_pedido = $_POST['id_pedido'];

            $sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
                $consulta = mysqli_query($mysqli, $sql);
                    $linha = mysqli_fetch_array($consulta);


            if (mysqli_num_rows($consulta) == 0) {
                echo "Pedido não encontrado! <br><br>";

            } else {
                session_start();
                    $_SESSION['id_pedido'] = $id_pedido;
        ?>

            <h2>Alterar Pedido</h2>
                <form method="POST" action="alterarPedido2.php">

                <h3>Dados Básicos</h3>

                    Novo Tipo*: <br/>
                    <input type="text" size="15" name="tipo_evento" value="<?php echo $linha['tipo_evento']?>"/>
                        <br/><br/>

                    Novo Horário de Início*: <br/>
                    <input type="datetime-local" name="inicio_evento" min="2000-01-01" value="<?php echo $linha['inicio_evento']?>"/>
                        <br/><br/>

                    Novo Horário de Termino: <br/>
                    <input type="datetime-local" name="fim_evento" min="2000-01-01" value="<?php echo $linha['fim_evento']?>"/>
                        <br/><br/>

                    Nova Quantidade de convidados*: <br/>
                    <input type="text" size="15" name="qtd_convidados" value="<?php echo $linha['qtd_convidados']?>"/>
                        <br/><br/>

                    Novo Endereço*: <br/>
                    <textarea name="endereco"><?php echo $linha['endereco']?></textarea>
                        <br/><br/>

                    Novas Observações*: <br/>
                    <textarea name="observacoes"><?php echo $linha['observacoes']?></textarea>
                        <br/><br/>

                    Novo Status*: <br/>
                        <input type="radio" name="status" value="Pendente" <?php if ($linha['status_pedido'] == "Pendente") { echo "checked='checked'";}?>/>
                            <label>Pendente</label><br>

                        <input type="radio" name="status" value="Em Revisão" <?php if ($linha['status_pedido'] == "Em Revisão") { echo "checked='checked'";}?>/>
                            <label>Em Revisão</label><br>

                        <input type="radio" name="status" value="Aguardando Pagamento" <?php if ($linha['status_pedido'] == "Aguardando Pagamento") { echo "checked='checked'";}?>/>
                            <label>Aguardando Pagamento</label><br>

                        <input type="radio" name="status" value="Confirmado" <?php if ($linha['status_pedido'] == "Confirmado") { echo "checked='checked'";}?>/>
                            <label>Confirmado</label><br>

                        <input type="radio" name="status" value="Pronto" <?php if ($linha['status_pedido'] == "Pronto") { echo "checked='checked'";}?>/>
                            <label>Pronto</label><br>
                        
                        <input type="radio" name="status" value="Cancelado" <?php if ($linha['status_pedido'] == "Cancelado") { echo "checked='checked'";}?>/>
                            <label>Cancelado</label><br>

                        <input type="radio" name="status" value="Concluído" <?php if ($linha['status_pedido'] == "Concluído") { echo "checked='checked'";}?>/>
                            <label>Concluído</label><br><br>

            <h2>Comidas</h2>

                <?php 
                    $sql = "SELECT * FROM comidas";
                        $consulta = mysqli_query($mysqli, $sql);

                    $id_esperado = 0;

                    while ($linha = mysqli_fetch_array($consulta)) {

                        while ($linha['id_comida'] != $id_esperado) {
                            
                            ?><input type="hidden" value ="0" name="qtd_comidas[<?php echo $id_esperado ?>]"><?php
                                $id_esperado++;
                        }     
                
                        $sql2 = "SELECT qtd_comida FROM pedido_comidas WHERE comida_id=${linha['id_comida']} AND pedido_id=$id_pedido";
                            $consulta2 = mysqli_query($mysqli, $sql2);
                                $qtd_antiga = (mysqli_num_rows($consulta2) == 0) ? 0 : mysqli_fetch_row($consulta2)[0];
                                    $_SESSION['qtd_antiga_comidas'][$linha['id_comida']] = $qtd_antiga;

                ?><!--Início do HTML-->

                        <hr>
                            <img src="<?php echo $linha['url_imagem_c'] ?>" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_comida'] ?></b> <br>
                            Preço por unidade: <b>R$ <?php echo $linha['preco_comida'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_comida'] ?></b> <br>
                            Tipo: <b><?php echo $linha['tipo']; ?></b> <br>
                            Categoria: <b><?php echo $linha['categoria']; ?></b> <br>
                            <br>
                            Qtd desejada atual: <b><?php echo $qtd_antiga ?></b> <br>
                            Nova Qtd desejada: <input type="number" value ="<?php echo $qtd_antiga ?>" min="0" max="<?php echo $linha['estoque_comida']; ?>" 
                                name="qtd_comidas[<?php $linha['id_comida'] ?>]">
                        <hr>

                <!--Fim do HTML--><?php
                        
                        $id_esperado = ($linha['id_comida']+1);
                    }
                ?>


            <!-- UTILITÁRIOS -->
            <br><h2>Utilitários</h2>

                <?php
                    $sql = "SELECT * FROM utilitarios";
                        $consulta = mysqli_query($mysqli, $sql);

                    $id_esperado = 0;

                    while ($linha = mysqli_fetch_array($consulta)) {

                        while ($linha['id_utilitario'] != $id_esperado) {
                            
                            ?><input type="hidden" value ="0" name="qtd_utilitarios[<?php echo $id_esperado ?>]"><?php
                                $id_esperado++;
                        }
                        
                        $sql2 = "SELECT qtd_utilitario FROM pedido_utilitarios WHERE utilitario_id=${linha['id_utilitario']} AND pedido_id=$id_pedido";
                            $consulta2 = mysqli_query($mysqli, $sql2);
                                $qtd_antiga = (mysqli_num_rows($consulta2) == 0) ? 0 : mysqli_fetch_row($consulta2)[0];
                                    $_SESSION['qtd_antiga_utilitarios'][$linha['id_utilitario']] = $qtd_antiga;

                ?><!--Início do HTML-->

                        <hr>
                            <img src="<?php echo $linha['url_imagem_u'] ?>" class="mostruario"> <br>

                            Nome: <b><?php echo $linha['nome_utilitario'] ?></b> <br>
                            Preço por unidade: <b>R$ <?php echo $linha['preco_utilitario'] ?></b> <br>
                            Qtd em Estoque: <b><?php echo $linha['estoque_utilitario'] ?></b> <br>
                            <br>
                            Qtd desejada atual: <b><?php echo $qtd_antiga ?></b> <br>
                            Nova Qtd desejada: <input type="number" value ="<?php echo $qtd_antiga ?>" min="0" max="<?php echo $linha['estoque_utilitario']; ?>" 
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

                    $max_cargo= array(); //Essas variáveis foram inicializadas vazias para evitar um erro de uso de valores escalares
                    $qtd_antiga = array(); 
                    

                    for($x = 0; $x < count($cargos); $x++) {
                        $cargo = $cargos[$x];
                        
                        $consulta = mysqli_stmt_execute($stmt); //Essa consulta foi utilizada para evitar um erro de sincronização
                        $resultado = mysqli_stmt_get_result($stmt);
                            $max_cargo[$x] = mysqli_num_rows($resultado);

                        $sql2 = "SELECT * FROM pedido_funcionarios WHERE funcionario_cpf IN (SELECT cpf_funcionario FROM funcionarios WHERE cargo='$cargo')";
                            $consulta2 = mysqli_query($mysqli, $sql2);
                                $qtd_antiga[$x] = mysqli_num_rows($consulta2);
                                    $_SESSION['qtd_antiga_funcionarios'][$cargo] = $qtd_antiga[$x];
                    }
                ?>

                        <!--Início do HTML-->
                        <hr>
                            Chefes de cozinha: <input type="number" value ="<?php echo $qtd_antiga[0]?>" min="0" max="<?php echo $max_cargo[0] ?>" name="qtd_cargos[Chefe de cozinha]"> (Qtd Antiga: <?php echo $qtd_antiga[0]?>) <br>
                            Ajudantes de cozinha: <input type="number" value ="<?php echo $qtd_antiga[1]?>" min="0" max="<?php echo $max_cargo[1] ?>" name="qtd_cargos[Ajudante de cozinha]"> (Qtd Antiga: <?php echo $qtd_antiga[1]?>) <br>
                            Copeiros: <input type="number" value ="<?php echo $qtd_antiga[2]?>" min="0" max="<?php echo $max_cargo[2] ?>" name="qtd_cargos[Copeiro]"> (Qtd Antiga: <?php echo $qtd_antiga[2]?>) <br>
                            Garçons: <input type="number" value ="<?php echo $qtd_antiga[3]?>" min="0" max="<?php echo $max_cargo[3] ?>" name="qtd_cargos[Garçom]"> (Qtd Antiga: <?php echo $qtd_antiga[3]?>) <br>
                            Barmans: <input type="number" value ="<?php echo $qtd_antiga[4]?>" min="0" max="<?php echo $max_cargo[4] ?>" name="qtd_cargos[Barman]"> (Qtd Antiga: <?php echo $qtd_antiga[4]?>) <br>
                            Recepcionistas: <input type="number" value ="<?php echo $qtd_antiga[5]?>" min="0" max="<?php echo $max_cargo[5] ?>" name="qtd_cargos[Recepcionista]"> (Qtd Antiga: <?php echo $qtd_antiga[5]?>) <br>
                            Seguranças: <input type="number" value ="<?php echo $qtd_antiga[6]?>" min="0" max="<?php echo $max_cargo[6] ?>" name="qtd_cargos[Segurança]"> (Qtd Antiga: <?php echo $qtd_antiga[6]?>) <br>
                            Faxineiros: <input type="number" value ="<?php echo $qtd_antiga[7]?>" min="0" max="<?php echo $max_cargo[7] ?>" name="qtd_cargos[Faxineiro]"> (Qtd Antiga: <?php echo $qtd_antiga[7]?>) <br>
                        <hr>


                <input type="submit" value="Alterar pedido" />
            </form>
            
            <a href="criarPedido.php">Voltar</a>
            
            <?php 
            }
        ?>

    </BODY>
</HTML>