<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Registrar Valor</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $descricao = $_POST['descricao'];

            if(strlen($nome) == 0 || strlen($preco) == 0 || strlen($estoque) == 0) {
                echo "Preencha todos os campos obrigatórios!";
            
            } else {

                $sql = "INSERT INTO produtos (nome_produto, preco_produto, estoque_produto, descricao_produto) VALUES ('$nome', $preco, $estoque, '$descricao')";
                    mysqli_query($mysqli, $sql);
                
                
                echo "Produto registrado com sucesso!";
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>
