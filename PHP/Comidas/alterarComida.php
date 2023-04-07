<?php
        include('../conexao.php');

            $id_comida = $_GET['id'];
            $nome = $_GET['name'];
            $preco = str_replace(",", ".", $_GET['price']);
            $estoque = $_GET['stock'];
            $categoria = $_GET['category'];
            $descricao = $_GET['desc'];
            
            if (empty($_GET['type'])) { 
                $tipo = ""; 

            } else { 
                $tipo = $_GET['type']; 
            }


            $sql = "SELECT * FROM comidas WHERE id_comida=$id_comida";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Comida não encontrada!";
                
            } else {
                    
                $coluna = mysqli_fetch_array($consulta);
                    if(empty($nome))      { $nome = $coluna["nome_comida"]; }
                    if(empty($preco))     { $preco = $coluna["preco_comida"]; }
                    if(empty($tipo))      { $tipo = $coluna["tipo"]; }
                    if(empty($categoria)) { $categoria = $coluna["categoria"]; }
                    if(empty($descricao)) { $descricao = $coluna["descricao_comida"]; }
                    if(strlen($estoque) == 0)   { $estoque = $coluna["estoque_comida"]; }

                    
                $sql = "UPDATE comidas SET nome_comida='$nome', preco_comida=$preco, estoque_comida=$estoque, tipo='$tipo', categoria='$categoria', descricao_comida='$descricao' WHERE id_comida='$id_comida'";
                    mysqli_query($mysqli, $sql);

                echo "Comida alterada com sucesso!";
            }