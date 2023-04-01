<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Funcionário</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $cpf = $_POST['cpf'];
            $nome = $_POST['nome'];
            $cargo = $_POST['cargo'];
            $salario = str_replace(",", ".", $_POST['salario']);
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
           

            $sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf'";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Funcionário não encontrado!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))      { $nome = $coluna["nome_funcionario"]; }
                    if(empty($cargo))     { $cargo = $coluna["cargo"]; }
                    if(empty($salario))   { $salario = $coluna["salario"]; }
                    if(empty($email))     { $email = $coluna["email_funcionario"]; }
                    if(empty($telefone))  { $telefone = $coluna["telefone_funcionario"]; }

                    
                $sql = "UPDATE funcionarios SET nome_funcionario='$nome', cargo='$cargo', salario=$salario, email_funcionario='$email', telefone_funcionario='$telefone' WHERE cpf_funcionario='$cpf'";
                    mysqli_query($mysqli, $sql);

                echo "Funcionário alterado com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>