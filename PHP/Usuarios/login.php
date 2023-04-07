<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Criar Conta</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            
            $sql = "SELECT * FROM usuarios WHERE email_usuario='$email' AND senha='$senha'";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Email ou senha incorretos!";

            } else {
                    
                echo "Login realizado com sucesso! <br>";

                $linha = mysqli_fetch_array($consulta);
                    $cpf = $linha['cpf'];

                //Se o CPF do usuário for o mesmo de um funcionário, então ele logará como funcionário, senão logará como cliente
                $sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "Logado como: Cliente";
                
                } else {
                    echo "Logado como: Funcionário";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>