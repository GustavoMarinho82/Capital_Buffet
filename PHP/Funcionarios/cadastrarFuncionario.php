<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Registrar Funcionário</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $cargo = $_POST['cargo'];
            $salario = str_replace(",", ".", $_POST['salario']);
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            if(strlen($nome) == 0 || strlen($cpf) == 0 || strlen($cargo) == 0 || strlen($salario) == 0 || strlen($email) == 0 || strlen($telefone) == 0) {
                echo "Preencha todos os campos!";
            
            } else {

                $sql = "INSERT INTO funcionarios (cpf_funcionario, nome_funcionario, cargo, salario, email_funcionario, telefone_funcionario) VALUES ('$cpf', '$nome', '$cargo', $salario, '$email', '$telefone')";
                    mysqli_query($mysqli, $sql);
                
                
                echo "Funcionário registrado com sucesso!";
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
