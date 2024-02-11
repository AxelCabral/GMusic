<?php
    session_start();
    if(empty($_SESSION['id'])|| $_SESSION['type'] == 1){
        header('location: error.html');
    }
?>
<div class="banner bg-login"></div>
<div class="main-container" id="appRoute">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Nova playlist</h3>
        </div>
        <div class="card-body">
            <form action="pdo/playlist-confirm.php" method="post" enctype="multipart/form-data" id='new-pl'>
                <div class="form-row form-group">
                    <label for="name" class="col-md-4 text-md-right col-form-label">Nome</label>
                    <div class="col-md-7">
                        <input type="text" name="song_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-group">
                    <label for="icon-file" class="col-md-4 text-md-right col-form-label">Imagem</label>
                    <div class="col-md-7">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="song_file" required>
                            <label class="custom-file-label" for="song_file">Escolher Arquivo</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <input type="submit" value="Criar Playlist" class="btn btn-brand btn-air">
                    </div>
                </div>
                </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#new-pl").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: 'pdo/playlist-confirm.php',
                success: function(data)
                {
                    $(".insert").html(data);
                    $("title").html("GMusic | New Playlist");
                }
            });
        });
    });
</script>