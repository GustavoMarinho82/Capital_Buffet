<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Cadastrar Produto</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $descricao = $_POST['descricao'];


            $sql = "INSERT INTO produtos (nome_produto, preco_produto, estoque_produto, descricao_produto) VALUES ('$nome', $preco, $estoque, '$descricao')";
                mysqli_query($mysqli, $sql);
                
            echo "Produto cadastrado com sucesso!";
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
