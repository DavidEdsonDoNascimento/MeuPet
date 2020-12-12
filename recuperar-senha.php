<?php include_once('cabecalho.php'); ?>
<?php session_destroy(); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Meu Pet</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Recuperação de senha</h3>
                            <p>Para confirmação da identidade responda as perguntas abaixo:</p>
                        </div>
                        <div class="card-body">
                            <form action="./src/recuperar-senha-db.php" class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Qual é seu e-mail?</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="email" id="email" placeholder="E-mail" required>
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Qual é seu CPF?</label>
                                    <input type="text" class="form-control form-control-lg rounded-0"  name="cpf" id="cpf" placeholder="CPF" required>
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnResgate">Resgatar</button>
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



