<?php
    session_start();
    if(isset($_SESSION['id'])&& $_SESSION['id'] != ""){
        $user_id = $_SESSION['id'];

        include_once ('pdo/DAO/user_DAO.php');
        include_once ('pdo/connection.php');

        $c = new connection();
        $conn = $c->connect();

        $select = new user_DAO();
        $stmt = $select->my_profile_info($conn, $user_id);

        foreach($stmt as $info){
            $name = $info->nome;
            $email = $info->email;
            $password = 'senhaencriptada';
            $alternative_password = $info->senha;
            $icon = $info->icone;
        }
    }
    else{
        header('location:error.html');
    }
?>
    <div class="banner bg-profile" id="profile-banner"></div>

    <div class="main-container under-banner-content" id="appRoute">

    <div class="row-flex-box section">
        <div class="col-xl-10 mx-auto" style="margin-top: -150px;">
            <div class="row-flex-box">
                <div class="col-xl-4 col-md-5">
                    <div class="card h-auto">
                        <div class="card-body-profile text-center">
                            <form action="pdo/change_image.php" method="post" enctype="multipart/form-data">
                                <input style='display: none;' type='file' id='profile-image' name='profile-image' required>
                                    <div class="avatar avatar-xl avatar-circle mx-auto mb-4">
                                    <label for="profile-image" title="Trocar Imagem" style="cursor: pointer;">
                                        <img src='assets/images/user_images/<?=$_SESSION['icon']?>' alt="user">
                                    </label>
                                    </div>
                                <h6 class="mb-3">Hello <?=$_SESSION['name']?></h6>
                                <p class="mb-1">Preferred by: 420x420(px)</p>
                                <p>Minimum: 128x128(px)</p>
                                <input type="hidden" name="email" value="<?=$email?>">
                                <button type="submit" class="btn btn-danger btn-air">Trocar Imagem</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-7">
                    <div class="card h-auto">
                        <div class="card-body-profile">
                            <form action="pdo/edit_profile.php" id='pInfo' method="post" class="row-flex-box" style="padding: 10%;">
                            <h5 class='profile-title'>Informações pessoais</h5>
                                <div class="col-12 form-group">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" name="name" class="form-control" value="<?=$name?>" id='name' required>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="mail" name="email" class="form-control" value="<?=$email?>" id='email' required>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="password" class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" value="<?=$password?>"
                                    id='password' required>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="alt_pass" value="<?=$alternative_password?>" id='altPass' required>
                                    <button type="submit" class="btn btn-primary btn-air">Alterar Informações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="plan-info-card text-center px-sm-5 py-sm-4 p-3">
                        <h6>Excluir conta</h6>
                        <p>Desejo excluir minha conta, pois a GMusic não atendeu as minhas expectativas.</p>
                        <a href="pdo/delete_account.php" class="btn btn-pill btn-success">Excluir conta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#pInfo").submit(function(e){
            e.preventDefault();

            var a = $("#name").val();
            var b = $("#email").val();
            var c = $("#password").val();
            var d = $("#altPass").val();

            $("#loading").css("display", "inherit");
            //Troca as informações do usuário
            $.post('pdo/edit_profile.php',
                { 
                    name: a,
                    email: b,
                    password: c,
                    altPass: d
                }
            );

            var link = 'profile.php';
            reload(link);
            $("#loading").delay(150).fadeOut();
        });
    });
    function reload(link){
        $.ajax({
            url: link,
            success: function(data)
            {
                $(".insert").html(data);
            }
        });
    }
</script>