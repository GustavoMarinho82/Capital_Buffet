<?php
            $abs_path = explode("/",str_replace("\\", "/",__DIR__));
            $max = sizeof($abs_path);
            $max--;
            $include = "";
            for($i = 0; $i < $max; $i++)
            {
            $include .= $abs_path[$i] . "/";
            }
            include($include . "conexao.php");
            

            $id_registro = $_POST['id_registro'];
            $data_registro = $_POST['data_registro'];
            $valor = str_replace(",", ".", $_POST['valor']);
            $descricao = $_POST['descricao'];
           

            $sql = "SELECT * FROM registros_financeiros WHERE id_registro=$id_registro";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Registro não encontrado!";
            
            } else {

                $coluna = mysqli_fetch_array($consulta);
                    if(empty($data_registro))   { $data_registro = $coluna["data_registro"]; }
                    if(empty($valor))     { $valor = $coluna["valor"]; }
                    if(empty($descricao)) { $descricao = $coluna["descricao"]; }


                $sql = "UPDATE registros_financeiros SET data_registro='$data_registro', valor=$valor, descricao='$descricao' WHERE id_registro=$id_registro";
                    mysqli_query($mysqli, $sql);

                echo "Registro alterado com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>