<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Pedido</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_pedido = $_POST['id_pedido'];


            $sql = "SELECT * FROM pedidos WHERE id_pedido=$id_pedido";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Pedido não encontrado!";
                
            } else {

                $sql = "DELETE FROM pedido_comidas WHERE pedido_id=$id_pedido";
                    mysqli_query($mysqli, $sql);

                $sql = "DELETE FROM pedido_utilitarios WHERE pedido_id=$id_pedido";
                    mysqli_query($mysqli, $sql);

                $sql = "DELETE FROM pedido_funcionarios WHERE pedido_id=$id_pedido";
                    mysqli_query($mysqli, $sql);

                $sql = "DELETE FROM pedidos WHERE id_pedido=$id_pedido";
                    mysqli_query($mysqli, $sql);

                echo "Pedido deletado com sucesso!";
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>