        <?php
        include "../conexao.php";
            $sql = "SELECT * FROM funcionarios";
            $consulta = mysqli_query($mysqli, $sql);
            $x = 0;
            
            while ($linha = mysqli_fetch_array($consulta)) {
                $cpf= $linha["cpf_funcionario"];
                $n= $linha["nome_funcionario"];
                $car= $linha["cargo"];
                $s= $linha["salario"];
                $e= $linha["email_funcionario"];
                $t= $linha["telefone_funcionario"];


                
                $x++;
            }
        