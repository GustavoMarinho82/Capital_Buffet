<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Conta</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $id_usuario = $_POST['id_usuario'];


            $sql = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo "Conta não encontrada!";
                
            } else {

                $sql = "SELECT * FROM pedidos WHERE usuario_id='$id_usuario'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) != 0) {
                    echo "Não foi possível deletar sua conta, porque você ainda possui pedidos ativos!";

                } else {

                    $sql = "DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
                        mysqli_query($mysqli, $sql);

                    echo "Conta deletada com sucesso!";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>