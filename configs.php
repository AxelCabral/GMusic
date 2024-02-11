<?php
    session_start();
    if(empty($_SESSION['id'])|| $_SESSION['type'] == 1){
        header('location: index.php');
    }
    if(empty($_SESSION['option'])){
        $pref = 'Álbums';
    }
    else{
        $pref = $_SESSION['option'];
        if($pref == '1'){
            $pref = 'Álbums';
        }
        else if($pref == '2'){
            $pref = 'Artistas';
        }
        else{
            $pref = 'Músicas';
        }
    }
?>
<div class="banner bg-home"></div>
<div class="main-container under-banner-content" id="appRoute">
    <div class="row-flex-box section">
        <div class="col-xl-8 col-md-10 mx-auto">
            <h5 class="mb-3">Preferência de busca 
            <p>Atualmente buscando por "<?=$pref?>"</p></h5>
            <div class="d-flex align-items-center" style="margin-top: 30px;">
                <label for="not1" class="setting-label pr-2">Pesquisar por Álbums</label>
                <div class="switch switch-primary ml-auto">
                    <input type="checkbox" id="not1" onchange="myFunction('opt1', this)">
                    <label for="not1"></label>
                </div>
            </div>
            <div class="d-flex align-items-center" style="margin-top: 10px;">
                <label for="not2" class="setting-label pr-2">Pesquisar por Artistas</label>
                <div class="switch switch-primary ml-auto">
                    <input type="checkbox" id="not2" onchange="myFunction('opt2', this)">
                    <label for="not2"></label>
                </div>
            </div>
            <div class="d-flex align-items-center" style="margin-top: 10px;">
                <label for="not3" class="setting-label pr-2">Pesquisar por Músicas</label>
                <div class="switch switch-primary ml-auto">
                    <input type="checkbox" id="not3" onchange="myFunction('opt3', this)">
                    <label for="not3"></label>
                </div>
            </div>
            <form action="#" method="post" id='preference-form' style="text-align: center;">
                <input name="option" type="hidden" value="" id="option">
                <input type="submit" class="btn btn-danger btn-air" value="Salvar Configurações">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#preference-form").submit(function(e){
            e.preventDefault();

            var a = $("#option").val();

            $.post('config_func.php',
                { 
                    config: a
                }
            );
            
            var link = 'configs.php';
            reload(link);
        });
    });
    function myFunction(a, b){
        var box = a;
        var check = b;
        if(box == 'opt1'){
            $('input[type="checkbox"]').not(check).prop('checked', false);
            $('input[type="hidden"]').val('1');
        }
        else if(box == 'opt2'){
            $('input[type="checkbox"]').not(check).prop('checked', false);
            $('input[type="hidden"]').val('2');
        }
        else if(box == 'opt3'){
            $('input[type="checkbox"]').not(check).prop('checked', false);
            $('input[type="hidden"]').val('3');
        }
        else{
            $('input[type="checkbox"]').prop('checked', false);
        }
    }
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