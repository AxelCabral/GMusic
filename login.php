<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
        if($_SESSION['type'] == 0){
            header('location:index.php');
        }
        else if($_SESSION['type'] == 1){
            header('location:index_art.php');
    }
}
?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<div class="banner bg-login"></div>
<div class="main-container" id="appRoute">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Login</h3>
        </div>
        <div class="card-body">
            <form action="pdo/login-confirm.php" method="post">
                <div class="form-row form-group">
                    <label for="email" class="col-md-4 text-md-right col-form-label">Email</label>
                    <div class="col-md-7">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-group">
                    <label for="password" class="col-md-4 text-md-right col-form-label">Senha</label>
                    <div class="col-md-7">
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-group">
                    <p class="login-option">Não possui uma conta?</p><a href="#">
                    <span>Cadastre-se!</span></a>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <input type="submit" value="Fazer Login" class="btn btn-brand btn-air">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("a").click(function(e){
            e.preventDefault();

            var a = $(this).find("span").text();

            if(a == "Cadastre-se!"){
                $("#loading").css("display", "inherit");
                $("a").not(this).removeClass("active");
                $("#1").addClass("active");
            // Exibir a página de registro
                $.ajax({
                    url: 'register.php',
                    success: function(data)
                    {
                        $("#loading").delay(150).fadeOut();
                        $(".insert").html(data);
                        $("title").html("GMusic | Registro");
                    }
                });
            }
        });
    });
</script>