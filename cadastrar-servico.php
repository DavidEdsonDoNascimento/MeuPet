<?php include_once('cabecalho.php'); ?>

<h1>Cadastro de serviço</h1>
<p>Cadastros > Serviços > Incluir</p>
<form action="src/cadastrar-servico-db.php" method="post">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <label for="">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
        <div class="col-sm-6 col-xs-12">
            <label for="">Descrição:</label>
            <input type="text" class="form-control" name="descricao" id="descricao">
        </div>

                
    <div class="col-sm-4 col-xs-4">
        <button type="submit" class="btn btn-success" style="margin-top:15px">Cadastrar</button>
    </div>
    </div>
</form>

<?php include_once('rodape.php'); ?>