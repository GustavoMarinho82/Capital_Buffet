<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Produto</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $id_produto = $_POST['id_produto'];
            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $descricao = $_POST['descricao'];
           

            $sql = "SELECT * FROM produtos WHERE id_produto=$id_produto";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Produto não encontrado!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))      { $nome = $coluna["nome_produto"]; }
                    if(empty($preco))     { $preco = $coluna["preco_produto"]; }
                    if(empty($descricao)) { $descricao = $coluna["descricao_produto"]; }
                    if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_produto"]; }

                    
                $sql = "UPDATE produtos SET nome_produto='$nome', preco_produto=$preco, estoque_produto=$estoque, descricao_produto='$descricao' WHERE id_produto=$id_produto";
                    mysqli_query($mysqli, $sql);

                echo "Produto alterado com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>