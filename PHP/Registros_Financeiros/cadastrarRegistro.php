<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Registrar Valor</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $data_registro = $_POST['data_registro'];
            $valor = str_replace(",", ".", $_POST['valor']);
            $descricao = $_POST['descricao'];


            $sql = "INSERT INTO registros_financeiros (data_registro, valor, descricao) VALUES ('$data_registro', $valor, '$descricao')";
                mysqli_query($mysqli, $sql);
       
            echo "Valor registrado com sucesso!";
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
