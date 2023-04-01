<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Deletar Funcionário</TITLE>
    </HEAD>

    <BODY>
        <?php
        include('../conexao.php');

            $cpf = $_POST['cpf'];

            if(strlen($cpf) == 0) {
                echo "Preencha todos os campos!";
            
            } else {

                $sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo "Funcionário não encontrado!";
                
                } else {

                    $sql = "SELECT * FROM pedido_funcionarios WHERE funcionario_cpf='$cpf'";
                        $consulta = mysqli_query($mysqli, $sql);

                    if (mysqli_num_rows($consulta) != 0) {
                        echo "Não é possível deletar o funcionário, porque ele faz parte de um pedido!";

                    } else {

                        $sql = "DELETE FROM funcionarios WHERE cpf_funcionario='$cpf'";
                            mysqli_query($mysqli, $sql);

                        echo "Funcionário deletado com sucesso!";
                    }
                }
            }
        ?>

        <p><a href="../index.html">Voltar</a>
    </BODY>
</HTML>