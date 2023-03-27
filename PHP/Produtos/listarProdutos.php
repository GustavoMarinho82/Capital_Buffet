<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Produtos</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Produtos</h2>
        
        <?php
        include "../conexao.php";
            $sql = "SELECT * FROM produtos";
            $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="500" cellspacing="0">
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Nome</th><th>Preço</th><th>Qtd em Estoque</th><th>Descrição</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $i= $linha["id_produto"];
                $n= $linha["nome_produto"];
                $p= $linha["preco_produto"];
                $q= $linha["estoque_produto"];
                $d= $linha["descricao_produto"];


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