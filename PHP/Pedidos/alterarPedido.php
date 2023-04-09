<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Alterar Observações</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_pedido = $_POST['id_pedido'];
            $observacoes = $_POST['observacoes'];
           

            $sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Pedido não encontrado!";
            
            } else {

                $sql = "UPDATE pedidos SET observacoes='$observacoes' WHERE id_pedido=$id_pedido";
                    mysqli_query($mysqli, $sql);

                echo "Observação alterada com sucesso!";
            }
        ?>
        
        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>