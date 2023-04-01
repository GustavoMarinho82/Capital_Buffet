<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Produto</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $id_produto = $_POST['id_produto'];


            $sql = "SELECT * FROM produtos WHERE id_produto=$id_produto";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Produto não encontrado!";
                
            } else {

                $sql = "SELECT * FROM pedido_produtos WHERE produto_id=$id_produto";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) != 0) {
                    echo "Não é possível deletar o produto, porque ele faz parte de um pedido!";

                } else {

                    $sql = "DELETE FROM produtos WHERE id_produto=$id_produto";
                        mysqli_query($mysqli, $sql);

                    echo "Produto deletado com sucesso!";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>