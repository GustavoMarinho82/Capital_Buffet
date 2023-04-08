<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Utilitários</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Utilitários</h2>
        
        <?php
            include "../conexao.php";
            
            $sql = "SELECT * FROM utilitarios";
                $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="900" cellspacing="0"> <!-- 900= 150*6 -->
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Nome</th><th>Preço</th><th>Em Estoque</th><th>Descrição</th><th>Imagem</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $i= $linha["id_utilitario"];
                $n= $linha["nome_utilitario"];
                $p= $linha["preco_utilitario"];
                $q= $linha["estoque_utilitario"];
                $d= $linha["descricao_utilitario"];
                $u= $linha["url_imagem_u"];



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
            <td><?php echo $d; ?></td>
            <td><?php echo "<button onclick=\"location.href='$u';\">Visualizar</button>";?></td>

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