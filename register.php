<div class="banner bg-login"></div>
<div class="main-container" id="appRoute">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Cadastro</h3>
        </div>
        <div class="card-body">
            <form action="pdo/register-confirm.php" method="post" enctype="multipart/form-data">
                <div class="form-row form-group">
                    <label for="name" class="col-md-4 text-md-right col-form-label">Nome</label>
                    <div class="col-md-7">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
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
                    <label for="password-c" class="col-md-4 text-md-right col-form-label">Confirmar Senha</label>
                    <div class="col-md-7">
                        <input type="password" name="password-c" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-group">
                    <label for="icon-file" class="col-md-4 text-md-right col-form-label">Imagem</label>
                    <div class="col-md-7">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="icon" required>
                            <label class="custom-file-label" for="icon">Escolher Arquivo</label>
                        </div>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-md-4"></div>
                    <div class="col-md-7">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="user-type-a" name="user-type" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="user-type-a">Artista</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="user-type-l" name="user-type" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="user-type-l">Ouvinte</label>
                        </div>
                    </div>
                </div>
            <div class="card-footer">
            <div class="row">
                    <input type="submit" value="Confirmar Cadastro" class="btn btn-brand btn-air">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="js/vendors.bundle.js"></script>
<script src="js/scripts.bundle.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/musicplayer.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="js/player-script.js"></script>