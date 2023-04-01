<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Comidas</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Comidas</h2>
        
        <?php
        include "../conexao.php";
            $sql = "SELECT * FROM comidas";
            $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="1050" cellspacing="0"> <!-- 1050= 150*7 -->
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Nome</th><th>Preço</th><th>Em Estoque</th><th>Tipo</th><th>Categoria</th><th>Descrição</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $i= $linha["id_comida"];
                $n= $linha["nome_comida"];
                $p= $linha["preco_comida"];
                $q= $linha["estoque_comida"];
                $t= $linha["tipo"];
                $c= $linha["categoria"];
                $d= $linha["descricao_comida"];


                if($x % 2 == 0){
                    $cor = "#DDDDDD";
                } else {
                    $cor = "#FFFFFF";
                }
        ?>
        <tr bgcolor="<?php echo $cor; ?>">
            <td><?php echo $i; ?></td>
            <td><?php echo $n; ?></td>
            <td><?php echo $p; ?></td>
            <td><?php echo $q; ?></td>
            <td><?php echo $t; ?></td>
            <td><?php echo $c; ?></td>
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