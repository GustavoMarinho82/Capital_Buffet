<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Utilitário</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $id_utilitario = $_POST['id_utilitario'];


            $sql = "SELECT * FROM utilitarios WHERE id_utilitario=$id_utilitario";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Utilitário não encontrado!";
                
            } else {

                $sql = "SELECT * FROM pedido_utilitarios WHERE utilitario_id=$id_utilitario";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) != 0) {
                    echo "Não é possível deletar o utilitario, porque ele faz parte de um pedido!";

                } else {

                    $sql = "DELETE FROM utilitarios WHERE id_utilitario=$id_utilitario";
                        mysqli_query($mysqli, $sql);

                    echo "Utilitário deletado com sucesso!";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>