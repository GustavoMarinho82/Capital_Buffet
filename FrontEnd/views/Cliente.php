<?php
  include("../../PHP/conexao.php");
  session_start();

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
    <title>Bem-vindo</title>
</head>
	<div id="settings" ontouchstart>
  <input checked class="nav" name="nav" type="radio" />
  <span class="nav">Conta</span>
  <input class="nav" name="nav" type="radio" />
  <span class="nav">Fazer Pedidos</span>
  <input class="nav" name="nav" type="radio"/>
  <span class="nav">Meus Pedidos</span>
  <input class="nav" name="voltar" type="radio"/>
  <span class="nav">Voltar para Home</span>
  <main class="content">
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
    <section id="account">
      <h2 class="title_material">Fazer Pedido</h2>
      <form>
        <ul>
          <li>
            <fieldset class="material">
              <div>
                <input required type="text" id="tipo"/>
                <label>Tipo de Evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input required type="number" id="orca"/>
                <label>Orçamento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input id="data" type="date" id="data"/>
                <label>Data do evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input required type="number" id="numconvidado"/>
                <label>Número estipulado dos convidados</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input required type="text" id="endereco"/>
                <label>Endereço do Evento</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
            <fieldset class="material">
              <div>
                <input required type="text" id="obs"/>
                <label>Observações</label>
                <hr />
              </div>
            </fieldset>
          </li>
          <li>
              <div>
                <a class="linkcardapio" onclick="redirecionar()" style="color: #ffe8be;">clique aqui para ir á página do cardápio</a>
                <hr />
              </div>
          </li>
          <li class="large padding">
            <fieldset class="material-button center">
              <div>
                <input onclick="criar()" class="save" type="submit" value="Criar" />
              </div>
            </fieldset>
          </li>
        </ul>
      </form>
    </section>
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