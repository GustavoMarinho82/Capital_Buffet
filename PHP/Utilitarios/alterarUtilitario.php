<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Utilitário</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_utilitario = $_POST['id_utilitario'];
            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $descricao = $_POST['descricao'];
            $url_imagem = $_POST['url_imagem'];
           

            $sql = "SELECT * FROM utilitarios WHERE id_utilitario=$id_utilitario";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Utilitário não encontrado!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))      { $nome = $coluna["nome_utilitario"]; }
                    if(empty($preco))     { $preco = $coluna["preco_utilitario"]; }
                    if(empty($descricao)) { $descricao = $coluna["descricao_utilitario"]; }
                    if(empty($url_imagem))  { $url_imagem = $coluna["url_imagem_u"]; }
                    if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_utilitario"]; }

                    
                $sql = "UPDATE utilitarios SET nome_utilitario='$nome', preco_utilitario=$preco, estoque_utilitario=$estoque, descricao_utilitario='$descricao', url_imagem_u='$url_imagem' WHERE id_utilitario=$id_utilitario";
                    mysqli_query($mysqli, $sql);

                echo "Utilitário alterado com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>