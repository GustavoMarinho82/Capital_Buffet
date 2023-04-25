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
                    $admin = $linha['admin'];

                if ($admin == 1) {
                    echo "Logado como: Funcionário administrador";
                
                } else {
                    echo "Logado como: Cliente";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>