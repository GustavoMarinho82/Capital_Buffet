<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Conta</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_usuario = $_POST['id_usuario'];
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $cep = $_POST['cep'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $admin = $_POST['admin'];
           

            $sql = "SELECT * FROM usuarios WHERE id_usuario=$id_usuario";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Conta não encontrada!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))        { $nome = $coluna["nome_usuario"]; }
                    if(empty($senha))       { $senha = $coluna["senha"]; }
                    if(empty($cep))         { $cep = $coluna["cep"]; }
                    if(empty($email))       { $email = $coluna["email_usuario"]; }
                    if(empty($telefone))    { $telefone = $coluna["telefone_usuario"]; }
                    if(strlen($admin) == 0)   { $admin = $coluna["admin"]; }


                    
                $sql = "UPDATE usuarios SET nome_usuario='$nome', senha='$senha', cep='$cep', email_usuario='$email', telefone_usuario='$telefone', admin=$admin WHERE id_usuario=$id_usuario";
                    mysqli_query($mysqli, $sql);

                echo "Conta alterada com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>