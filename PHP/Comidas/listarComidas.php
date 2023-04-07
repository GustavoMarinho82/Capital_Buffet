<?php
        include '../conexao.php';
            $sql = 'SELECT * FROM comidas';
            $consulta = mysqli_query($mysqli, $sql);
            $return= '';
            
            while ($linha = mysqli_fetch_array($consulta)) {

                $i= $linha['id_comida'];
                $n= $linha['nome_comida'];
                $p= $linha['preco_comida'];
                $q= $linha['estoque_comida'];
                $t= $linha['tipo'];
                $c= $linha['categoria'];
                $d= $linha['descricao_comida'];
 
                $return .= '{"id":"'.$i.'","name":"'.$n.'","price":"'.$p.'","stock":"'.$q.'","type":"'.$t.'","cat":"'.$c.'","desc":"'.$d.'"}|';
            }

//$return .= '}';            
echo $return;