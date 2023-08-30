<?php
  include("../../PHP/conexao.php");
  session_start();
  
  $min_p = date('Y-m-d h:i', strtotime('+14 day'));
  $max_p = date('Y-m-d h:i', strtotime('+2 year'));

  $id_usuario = $_SESSION['id_usuario'];

  $sql = "SELECT * FROM usuarios WHERE id_usuario=$id_usuario";
    $consultaU = mysqli_query($mysqli, $sql);
      $colunaU = mysqli_fetch_array($consultaU);

  $sql = "SELECT * FROM pedidos WHERE usuario_id=$id_usuario";
    $consultaP = mysqli_query($mysqli, $sql);
?>

<head>
    <link rel="stylesheet" href="../css/cliente_style.css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central do Cliente</title>
</head>
	<div id="settings" ontouchstart>
  <input class="nav" name="nav" type="radio" <?php if (!isset($_SESSION['pedido_feito'])) { echo "checked";}?>/>
  <span class="nav">Conta</span>
  <input class="nav" name="nav" type="radio" />
  <span class="nav">Fazer Pedido</span>
  <input class="nav" name="nav" type="radio" <?php if (isset($_SESSION['pedido_feito'])) { echo "checked";}?>/>
  <span class="nav">Meus Pedidos</span>
  <input class="nav" name="voltar" type="radio"/>
  <span class="nav">Voltar pra Home</span>
  <main class="content">
    
  <?php unset($_SESSION['pedido_feito']); ?>

    <!-- CONTA -->  
    <section id="profile">
      <h2 class="title_material">Bem-vindo</h2>
      <form>
        <ul>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php echo $colunaU['nome_usuario'];?>"/>
                <label>Nome</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php if (is_null($colunaU['cpf'])) {echo $colunaU['cnpj'];} else {echo $colunaU['cpf'];}?>"/>
                <label>CPF/CNPJ</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php echo $colunaU['cep'];?>"/>
                <label>CEP</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php echo $colunaU['telefone_usuario'];?>"/>
                <label>Telefone</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php echo $colunaU['email_usuario'];?>"/>
                <label>E-mail</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" value="<?php echo $colunaU['senha'];?>"/>
                <label>Senha</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li class="large padding">
            <fieldset class="material-button center">
              <div>
                <input class="save" type="submit" value="Atualizar" onClick="window.location.reload()"/>
              </div>
            </fieldset>
          </li>
        </ul>
      </form>
    </section>


    <!-- FAZER PEDIDO -->
    <section id="account">
      <h2 class="title_material">Fazer Pedido</h2>
      <form method="POST" action="./Pedido.php">
        <ul>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" name="tipo_evento" required/>
                <label>Tipo de Evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="datetime-local" name="inicio_evento" min="<?php echo $min_p ?>" max="<?php echo $max_p ?>" required/>
                <label>Início do Evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="number" name="duracao" min="0" max="12" required/>
                <label>Duração em Horas (até 12)</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="number" name="qtd_convidados" required/>
                <label>Número de Convidados</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" name="endereco" required/>
                <label>Endereço do Evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input type="text" name="observacoes" required/>
                <label>Observações</label>
                <hr />
              </div>
            </fieldset>
          </li>

          <li class="large padding">
            <fieldset class="material-button center">
              <div>
                <input class="save" type="submit" value="Continuar" />
              </div>
            </fieldset>
          </li>
        </ul>
      </form>
    </section>


    <!-- MEUS PEDIDOS -->
    <section id="profile">
      <h2 class="title_material">Meus Pedidos</h2>

      <?php 
        if (mysqli_num_rows($consultaP) == 0) {
          ?> <br><br><center>Você ainda não fez nenhum pedido!</center><?php

        } else {
          while ($linha = mysqli_fetch_array($consultaP)) {
      ?>
              <center>
              <h3>Pedido de ID <?php echo $linha["id_pedido"]?></h3>

              <table border="1" width="550" cellspacing="0"> 
                <tr bgcolor="#ffe8be"><th>Tipo do Evento</th><th>Orçamento</th><th>Data do Pedido</th><th>Início do Evento</th><th>Fim do Evento</th></tr>

                <tr style="color:#ffe8be; text-align:center">
                    <td><?php echo $linha["tipo_evento"]; ?></td>
                    <td>R$ <?php echo $linha["orcamento"]; ?></td>
                    <td><?php echo $linha["data_pedido"];; ?></td>
                    <td><?php echo $linha["inicio_evento"]; ?></td>
                    <td><?php echo $linha["fim_evento"]; ?></td>
                </tr>
              </table>

              <table border="1" width="550" cellspacing="0">
                <tr bgcolor="#ffe8be"><th>N° de Convidados</th><th>Endereço</th><th>Observações</th><th>Status do Pedido</th></tr>

                <tr style="color:#ffe8be; text-align:center">
                    <td><?php echo $linha["qtd_convidados"]; ?></td>
                    <td><?php echo $linha["endereco"]; ?></td>
                    <td><?php echo $linha["observacoes"]; ?></td>
                    <td><?php echo $linha["status_pedido"]; ?></td>
                </tr>
              </table>
          </center>
      <?php
          } 
        }
      ?>
    
    </section>

  </main>
	</div>
<script src="../views/Empresa/javascript/functions.js"></script>
<script src="../javascript/pedido.js"></script>

<script src="../dependencias/jquery-2.1.4.min.js"></script>
<script>
  $('input[name="voltar"]').on('click', function() {
      window.location = "/Capital_Buffet/FrontEnd/views/"});
</script>