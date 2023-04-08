<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Pedidos</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Pedidos</h2>
        
        <?php
            include "../conexao.php";

            $sql = "SELECT * FROM pedidos";
                $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="1400" cellspacing="0"> <!-- 2100= 150*14 -->
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Tipo do Evento</th><th>Orçamento</th><th>Status</th><th>Data do Pedido</th><th>Início</th><th>Fim</th><th>Qtd de Convidados</th><th>Endereço</th><th>Observações</th><th>Comidas</th><th>Utilitários</th><th>Funcionários</th><th>ID do Cliente</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $id_p=$linha["id_pedido"];
                $t=$linha["tipo_evento"];
                $o=$linha["orcamento"];
                $s=$linha["status_pedido"];
                $d=$linha["data_pedido"];
                $i_e=$linha["inicio_evento"];
                $f=$linha["fim_evento"];
                $c=$linha["qtd_convidados"];
                $e=$linha["endereco"];
                $obs=$linha["observacoes"];
                $id_u=$linha["usuario_id"];

                if($x % 2 == 0){
                    $cor = "#DDDDDD";
                } else {
                    $cor = "#FFFFFF";
                }
        ?>
        <tr bgcolor="<?php echo $cor; ?>">
            <td><?php echo $id_p; ?></td>
            <td><?php echo $t; ?></td>
            <td><?php echo $o; ?></td>
            <td><?php echo $s; ?></td>
            <td><?php echo $d; ?></td>
            <td><?php echo $i_e; ?></td>
            <td><?php echo $f; ?></td>
            <td><?php echo $c; ?></td>
            <td><?php echo $e; ?></td>
            <td><?php echo $obs; ?></td>
            <td><?php echo "<button onclick=\"location.href='listarPedidos2.php?id_pedido=$id_p&tabela=C';\">Visualizar</button>";?></td>
            <td><?php echo "<button onclick=\"location.href='listarPedidos2.php?id_pedido=$id_p&tabela=U';\">Visualizar</button>";?></td>
            <td><?php echo "<button onclick=\"location.href='listarPedidos2.php?id_pedido=$id_p&tabela=F';\">Visualizar</button>";?></td>
            <td><?php echo $id_u; ?></td>
        </tr>
        
        <?php
                $x++;
            }
        ?>

        </table>
            <br/>

        <a href="../index.html">Voltar</a>
    </BODY>
</HTML>