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
           
            if(strlen($id_produto) == 0) {
                echo "Preencha o campo obrigatório!";
            
            } else {

                $sql = "SELECT * FROM produtos WHERE id_produto=$id_produto";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "Produto não encontrado!";
                
                } else {
                    
                    $coluna = mysqli_fetch_array($consulta);

                        if(strlen($nome) == 0)      { $nome = $coluna["nome_produto"]; }
                        if(strlen($preco) == 0)     { $preco = $coluna["preco_produto"]; }
                        if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_produto"]; }
                        if(strlen($descricao) == 0) { $descricao = $coluna["descricao_produto"]; }

                    $sql = "UPDATE produtos SET nome='$nome_produto', preco=$preco_produto, estoque=$estoque_produto, descricao='$descricao' WHERE id_produto=$id_produto";
                        mysqli_query($mysqli, $sql);

                    echo "Produto alterado com sucesso!";
                }
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>