<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Pedidos</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Pedidos</h2>
        
        <?php
            include "../conexao.php";
        
            $id_pedido = $_GET['id_pedido'];

        //COMIDAS
            if ($_GET['tabela'] == "C") {
               
                $sql = "SELECT * FROM pedido_comidas WHERE pedido_id=$id_pedido";
                    $consulta = mysqli_query($mysqli, $sql);
        ?>
            
            <table border="1" width="450" cellspacing="0"> <!-- 450= 150*3 -->
            <tr bgcolor="#BBBBBB">
            <th>ID do Pedido</th><th>ID da Comida</th><th>Quantidade solicitada</th>
            </tr>
            
        <?php
                $x = 0;
            
                while ($linha = mysqli_fetch_array($consulta)) {
                    $c=$linha["comida_id"];
                    $q=$linha["qtd_comida"];
    
                    if($x % 2 == 0){
                        $cor = "#DDDDDD";
                    } else {
                        $cor = "#FFFFFF";
                    }
        ?>

            <tr bgcolor="<?php echo $cor; ?>">
                <td><?php echo $id_pedido; ?></td>
                <td><?php echo $c; ?></td>
                <td><?php echo $q; ?></td>
            </tr>
            
        <?php
                    $x++;
                }


        //UTILITÁRIOS
            } else if ($_GET['tabela'] == "U") {
               
                $sql = "SELECT * FROM pedido_utilitarios WHERE pedido_id=$id_pedido";
                    $consulta = mysqli_query($mysqli, $sql);
        ?>
            
            <table border="1" width="450" cellspacing="0"> <!-- 450= 150*3 -->
            <tr bgcolor="#BBBBBB">
            <th>ID do Pedido</th><th>ID do Utilitário</th><th>Quantidade solicitada</th>
            </tr>
            
        <?php
                $x = 0;
            
                while ($linha = mysqli_fetch_array($consulta)) {
                    $u=$linha["utilitario_id"];
                    $q=$linha["qtd_utilitario"];
    
                    if($x % 2 == 0){
                        $cor = "#DDDDDD";
                    } else {
                        $cor = "#FFFFFF";
                    }
        ?>

            <tr bgcolor="<?php echo $cor; ?>">
                <td><?php echo $id_pedido; ?></td>
                <td><?php echo $u; ?></td>
                <td><?php echo $q; ?></td>
            </tr>
            
        <?php
                    $x++;
                }
                

        //FUNCIONÁRIOS
            } else if ($_GET['tabela'] == "F") {
               
                $sql = "SELECT * FROM pedido_funcionarios WHERE pedido_id=$id_pedido";
                    $consulta = mysqli_query($mysqli, $sql);
        ?>
            
            <table border="1" width="300" cellspacing="0"> <!-- 300= 150*2 -->
            <tr bgcolor="#BBBBBB">
            <th>ID do Pedido</th><th>CPF do Funcionário</th>
            </tr>
            
        <?php
                $x = 0;
            
                while ($linha = mysqli_fetch_array($consulta)) {
                    $c=$linha["funcionario_cpf"];
    
                    if($x % 2 == 0){
                        $cor = "#DDDDDD";
                    } else {
                        $cor = "#FFFFFF";
                    }
        ?>

            <tr bgcolor="<?php echo $cor; ?>">
                <td><?php echo $id_pedido; ?></td>
                <td><?php echo $c; ?></td>
            </tr>
            
        <?php
                    $x++;
                }
            }
        ?>

            </table>
            <br/>

        <a href="listarPedidos.php">Voltar</a>
    </BODY>
</HTML>