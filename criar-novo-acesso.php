<?php 
    include_once('cabecalho.php'); 
    session_destroy(); 
    
    if(!isset($_GET['senhatemporaria']))
        header("location:recuperar-senha.php");

    $senhatemporaria = $_GET['senhatemporaria'];
?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Meu Pet</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Recuperando Acessos</h3>
                        </div>
                        <div class="card-body">
                            <form action="./src/criar-novo-acesso-db.php" class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">CPF</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="cpf" id="cpf" placeholder="CPF" required>
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>    
                                <div class="form-group">
                                    <label for="uname1">Nova Senha</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="novasenha" id="novasenha" placeholder="Nova senha" required>
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Confirme nova senha</label>
                                    <input type="password" class="form-control form-control-lg rounded-0"  name="confirmenovasenha" id="confirmenovasenha" placeholder="Confirme nova senha" required>
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnResgate">Novo Acesso</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->

<?php include_once('rodape.php'); ?>



