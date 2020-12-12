<?php include_once('cabecalho-login.php'); ?>
<?php session_destroy(); ?>
<script>
$(document).ready(function(){

    $("#btn-login").click(function(){
        usuario = $("#usuario")[0].value;
        senha = $("#senha")[0].value;
        if(usuario == "" || senha == ""){
            $("#mensagem-erro")[0].textContent = "Usuário ou senha não podem ser em brancos!";
            $("#mensagem-erro").css("display", "block");
        }
        else{
            $.ajax({
                url: "./src/valida-acesso.php",
                type: "POST",
                data: {
                    usuario: usuario,
                    senha: senha
                },
                success: function(r){
                    result = JSON.parse(r);
                    if(result.success == true)
                        window.location.href = "monitoramento.php";
                    else
                        $("#mensagem-erro")[0].textContent = "Usuário ou senha incorretas!";
                        $("#mensagem-erro").css("display", "block");
                },
                error: function(e){
                    console.log(e);
                }
            });
        }

    });
});

</script>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Meu Pet</h1>
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <!-- <form action="" class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST"> -->
                                <div class="form-group">
                                    <label for="uname1">Usuário:</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="usuario" id="usuario" placeholder="Usuário" required>
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Senha:</label>
                                    <input type="password" class="form-control form-control-lg rounded-0"  name="senha" id="senha" placeholder="Senha"  autocomplete="new-password" required>
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <p class="alert-danger text-center" id="mensagem-erro" style="display:none"></p>
                                <p class="message" style="color:#0d0d0d"><a href="recuperar-senha.php">Esqueceu a senha?</a></p>
                                <button type="button" class="btn btn-primary btn-lg float-right" id="btn-login">Acessar</button>
                            <!-- </form> -->
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



