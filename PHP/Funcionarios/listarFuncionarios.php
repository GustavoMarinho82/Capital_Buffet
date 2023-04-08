<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Listar Funcionários</TITLE>
    </HEAD>

    <BODY>
        <h2>Listar Funcionários</h2>
        
        <?php
            include "../conexao.php";
            
            $sql = "SELECT * FROM funcionarios";
                $consulta = mysqli_query($mysqli, $sql);
        ?>

        <table border="1" width="900" cellspacing="0"> <!-- 900= 150*6 -->
        <tr bgcolor="#BBBBBB">
        <th>CPF</th><th>Nome</th><th>Cargo</th><th>Salário</th><th>Email</th><th>Telefone</th>
        </tr>

        <?php
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $cpf= $linha["cpf_funcionario"];
                $n= $linha["nome_funcionario"];
                $car= $linha["cargo"];
                $s= $linha["salario"];
                $e= $linha["email_funcionario"];
                $t= $linha["telefone_funcionario"];


                if($x % 2 == 0){
                    $cor = "#DDDDDD";
                } else {
                    $cor = "#FFFFFF";
                }
        ?>
        <tr bgcolor="<?php echo $cor; ?>">
            <td><?php echo $cpf; ?></td>
            <td><?php echo $n; ?></td>
            <td><?php echo $car; ?></td>
            <td><?php echo $s; ?></td>
            <td><?php echo $e; ?></td>
            <td><?php echo $t; ?></td>
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