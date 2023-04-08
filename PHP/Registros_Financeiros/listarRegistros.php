<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Registros</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Registros</h2>
        
        <?php
            include "../conexao.php";
            
            $sql = "SELECT * FROM registros_financeiros";
                $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="600" cellspacing="0"> <!-- 600= 150*4 -->
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Período</th><th>Valor</th><th>Descrição</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $i= $linha["id_registro"];
                $p= $linha["periodo"];
                $v= $linha["valor"];
                $d= $linha["descricao"];


                if($x % 2 == 0){
                    $cor = "#DDDDDD";
                } else {
                    $cor = "#FFFFFF";
                }
        ?>
        <tr bgcolor="<?php echo $cor; ?>">
            <td><?php echo $i; ?></td>
            <td><?php echo $p; ?></td>
            <td><?php echo $v; ?></td>
            <td><?php echo $d; ?></td>
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