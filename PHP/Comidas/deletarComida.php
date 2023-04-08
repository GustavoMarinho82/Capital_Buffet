<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Comida</TITLE>
    </HEAD>

    <BODY>
        <?php
            include('../conexao.php');

            $id_comida = $_POST['id_comida'];


            $sql = "SELECT * FROM comidas WHERE id_comida=$id_comida";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Comida não encontrada!";
                
            } else {

                $sql = "SELECT * FROM pedido_comidas WHERE comida_id=$id_comida";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) != 0) {
                    echo "Não é possível deletar a comida, porque ela faz parte de um pedido!";

                } else {

                    $sql = "DELETE FROM comidas WHERE id_comida=$id_comida";
                        mysqli_query($mysqli, $sql);

                    echo "Comida deletada com sucesso!";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>