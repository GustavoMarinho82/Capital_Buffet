<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Cadastrar Utilitário</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $descricao = $_POST['descricao'];
            $url_imagem = $_POST['url_imagem'];


            $sql = "INSERT INTO utilitarios (nome_utilitario, preco_utilitario, estoque_utilitario, descricao_utilitario, url_imagem_u) VALUES ('$nome', $preco, $estoque, '$descricao', '$url_imagem')";
                mysqli_query($mysqli, $sql);
                
            echo "Utilitário cadastrado com sucesso!";
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
