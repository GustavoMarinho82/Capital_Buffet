<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Registrar Valor</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $periodo = $_POST['periodo'];
            $valor = str_replace(",", ".", $_POST['valor']);
            $descricao = $_POST['descricao'];


            $sql = "INSERT INTO registros_financeiros (periodo, valor, descricao) VALUES ('$periodo', $valor, '$descricao')";
                mysqli_query($mysqli, $sql);
       
            echo "Valor registrado com sucesso!";
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
