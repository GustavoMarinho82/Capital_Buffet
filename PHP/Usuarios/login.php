<?php
        include('../conexao.php');

            $email = $_GET['email'];
            $senha = $_GET['senha'];

            
            $sql = "SELECT * FROM usuarios WHERE email_usuario='$email' AND senha='$senha'";
                $consulta = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($consulta) == 0) {
                echo json_encode(array("status"=>"falha", "causa"=>"dados incorretos ou conta não cadastrada"));

            } else {

                $linha = mysqli_fetch_array($consulta);
                    $cpf = $linha['cpf'];

                //Se o CPF do usuário for o mesmo de um funcionário, então ele logará como funcionário, senão logará como cliente
                $sql = "SELECT * FROM funcionarios WHERE cpf_funcionario='$cpf'";
                    $consulta = mysqli_query($mysqli, $sql);

                if (mysqli_num_rows($consulta) == 0) {
                    echo json_encode(array("status"=>"sucesso", "log"=>"cliente"));
                
                } else {
                    echo json_encode(array("status"=>"sucesso", "log"=>"funcionario"));
                }
            }