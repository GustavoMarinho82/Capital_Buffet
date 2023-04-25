<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Contas</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Contas</h2>
        
        <?php
            include "../conexao.php";
            
            $sql = "SELECT * FROM usuarios";
                $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="1050" cellspacing="0"> <!-- 1050= 150*7 -->
        <tr bgcolor="#BBBBBB">
        <th>ID</th><th>Nome</th><th>Senha</th><th>CPF/CNPJ</th><th>CEP</th><th>Email</th><th>Telefone</th><th>Privilégio</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $i= $linha["id_usuario"];
                $n= $linha["nome_usuario"];
                $s= $linha["senha"];
                $cpf= $linha["cpf"];
                $cnpj= $linha["cnpj"];
                $cep= $linha["cep"];
                $e= $linha["email_usuario"];
                $t= $linha["telefone_usuario"];
                $a= $linha["admin"];

                $p = ($a == 1) ? "Func. Admin" : "Cliente";


                if ($x % 2 == 0){
                    $cor = "#DDDDDD";
                } else {
                    $cor = "#FFFFFF";
                }
        ?>
        <tr bgcolor="<?php echo $cor; ?>">
            <td><?php echo $i; ?></td>
            <td><?php echo $n; ?></td>
            <td><?php echo $s; ?></td>
            <td><?php echo empty($cnpj) ? $cpf : $cnpj;?></td>
            <td><?php echo $cep; ?></td>
            <td><?php echo $e; ?></td>
            <td><?php echo $t; ?></td>
            <td><?php echo $p; ?></td>
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