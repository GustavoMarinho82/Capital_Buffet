<?php
            include('../conexao.php');

            $nome = $_GET['nome'];
            $preco = str_replace(",", ".", $_GET['preco']);
            $estoque = $_GET['estoque'];
            $descricao = $_GET['descricao'];
            $url_imagem = $_GET['imagem'];


            $sql = "INSERT INTO utilitarios (nome_utilitario, preco_utilitario, estoque_utilitario, descricao_utilitario, url_imagem_u) VALUES ('$nome', $preco, $estoque, '$descricao', '$url_imagem')";
                mysqli_query($mysqli, $sql);
                
            echo "Utilitário cadastrado com sucesso!";