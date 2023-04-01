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
            
            if (isset($_POST['tipo'])) { $tipo = $_POST['tipo']; } 
                else { $tipo = ""; }


            $sql = "SELECT * FROM comidas WHERE id_comida=$id_comida";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Comida não encontrada!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(strlen($nome) == 0)      { $nome = $coluna["nome_comida"]; }
                    if(strlen($preco) == 0)     { $preco = $coluna["preco_comida"]; }
                    if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_comida"]; }
                    if(strlen($tipo) == 0)      { $tipo = $coluna["tipo"]; }
                    if(strlen($categoria) == 0) { $categoria = $coluna["categoria"]; }
                    if(strlen($descricao) == 0) { $descricao = $coluna["descricao_comida"]; }

                    
                $sql = "UPDATE comidas SET nome_comida='$nome', preco_comida=$preco, estoque_comida=$estoque, tipo='$tipo', categoria='$categoria', descricao_comida='$descricao' WHERE id_comida='$id_comida'";
                    mysqli_query($mysqli, $sql);

                echo "Comida alterada com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>