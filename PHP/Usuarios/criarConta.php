<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Criar Conta</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            //Confere se ambos não foram inicializados
            if (empty($_POST['cpf']) && empty($_POST['cnpj'])) {
                echo "É obrigatório registrar um CPF ou um CNPJ";

            //O isset() returna true mesmo quando a variável está vazia, então foi necessário usar o strlen()
            } else if (strlen($_POST['cpf']) != 0 && strlen($_POST['cnpj']) != 0) {
                    echo "Não é permitido registrar CPF e CNPJ na mesma conta";

            } else {

                $nome = $_POST['nome'];
                $senha = $_POST['senha'];
                $cpf = $_POST['cpf'];
                $cnpj = $_POST['cnpj'];
                $cep = $_POST['cep'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];


                //Foi usado AND em vez de OR porque se, por exemplo, o cpf for igual a "NULL" sempre irá dar true se o usuário não tiver o cpf registrado
                $sql = "SELECT * FROM usuarios WHERE (cpf='$cpf' AND cnpj='$cnpj') OR email_usuario='$email'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) != 0) {
                    echo "CPF, CNPJ ou Email já registrados!";

                } else if (strlen($cpf) != 0) {
                            
                    $sql = "INSERT INTO usuarios (nome_usuario, senha, cpf, cep, email_usuario, telefone_usuario) VALUES ('$nome', '$senha', '$cpf', '$cep', '$email', '$telefone')";
                        mysqli_query($mysqli, $sql);

                } else {

                    $sql = "INSERT INTO usuarios (nome_usuario, senha, cnpj, cep, email_usuario, telefone_usuario) VALUES ('$nome', '$senha', '$cnpj', '$cep', '$email', '$telefone')";
                        mysqli_query($mysqli, $sql);
                }
                            
                echo "Conta criada com sucesso!";
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>