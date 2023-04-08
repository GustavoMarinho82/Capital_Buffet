<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Cadastrar Comida</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $tipo = $_POST['tipo'];
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];


            $sql = "INSERT INTO comidas (nome_comida, preco_comida, estoque_comida, tipo, categoria, descricao_comida) VALUES ('$nome', $preco, $estoque, '$tipo', '$categoria', '$descricao')";
                mysqli_query($mysqli, $sql);
                
            echo "Comida cadastrada com sucesso!";
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
