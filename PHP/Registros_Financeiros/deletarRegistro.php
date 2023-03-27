<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Registro</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $id_registro = $_POST['id_registro'];

            if(strlen($id_registro) == 0) {
                echo "Preencha todos os campos!";
            
            } else {

                $sql = "SELECT * FROM registros_financeiros WHERE id_registro=$id_registro";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "Registro não encontrado!";
                
                } else {

                    $sql = "DELETE FROM registros_financeiros WHERE id_registro=$id_registro";
                        mysqli_query($mysqli, $sql);

                    echo "Registro deletado com sucesso!";
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>