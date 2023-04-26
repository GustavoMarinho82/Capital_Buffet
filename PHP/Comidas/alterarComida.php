<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Comida</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_comida = $_POST['id_comida'];
            $nome = $_POST['nome'];
            $preco = str_replace(",", ".", $_POST['preco']);
            $estoque = $_POST['estoque'];
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];
            $url_imagem = $_POST['url_imagem'];
            
            if (empty($_POST['tipo'])) { 
                $tipo = ""; 

            } else { 
                $tipo = $_POST['tipo']; 
            }


            $sql = "SELECT * FROM comidas WHERE id_comida=$id_comida";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Comida não encontrada!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))        { $nome = $coluna["nome_comida"]; }
                    if(empty($preco))       { $preco = $coluna["preco_comida"]; }
                    if(empty($tipo))        { $tipo = $coluna["tipo"]; }
                    if(empty($categoria))   { $categoria = $coluna["categoria"]; }
                    if(empty($descricao))   { $descricao = $coluna["descricao_comida"]; }
                    if(empty($url_imagem))  { $url_imagem = $coluna["url_imagem_c"]; }
                    if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_comida"]; }
                    

                $sql = "UPDATE comidas SET nome_comida='$nome', preco_comida=$preco, estoque_comida=$estoque, tipo='$tipo', categoria='$categoria', descricao_comida='$descricao', url_imagem_c='$url_imagem' WHERE id_comida='$id_comida'";
                    mysqli_query($mysqli, $sql);

                echo "Comida alterada com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>