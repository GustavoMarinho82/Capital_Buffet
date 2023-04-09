<?php 
    //date() -> consegue a data atual;
    //strtotime -> foi usado para não ser possível fazer um pedido que vai acontecer em menos de 14 dias e em mais de 2 anos
    $min_p = date('Y-m-d h:i', strtotime('+14 day'));
    $max_p = date('Y-m-d h:i', strtotime('+2 year'));
?>

<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Fazer Pedido</TITLE>
    </HEAD>

    <BODY>
        <h2>Fazer Pedido</h2>
            <form method="POST" action="fazerPedido2.php">

                Tipo do evento: <br/>
                <input type="text" size="15" name="tipo_evento" required/>
                    <br/><br/>

                Início evento: <br/>
                <input type="datetime-local" name="inicio_evento" min="<?php echo $min_p ?>" max="<?php echo $max_p ?>" required/>
                    <br/><br/>

                Duração do evento (em horas): <br/>
                <input type="number" name="duracao" min="0" max="12" required/>
                    <br/><br/>

                Quantidade de convidados: <br/>
                <input type="text" size="15" name="qtd_convidados" required/>
                    <br/><br/>

                Endereço: <br/>
                <textarea name="endereco" required></textarea>
                    <br/><br/>

                Observações (opcional): <br/>
                <textarea name="observacoes"></textarea>
                    <br/><br/>


                <input type="submit" value="Continuar" />
            </form>
            
            <a href="../index.html">Voltar</a>
    </BODY>
</HTML>