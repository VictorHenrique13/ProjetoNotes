<?php
include_once __DIR__.DIRECTORY_SEPARATOR."../../Controller/library/aviso_erro.php";
$aviso_erro = buscarErroOuAviso();
$msg = $aviso_erro["msg"];$tipo= $aviso_erro["tipo"];$cod = $aviso_erro["cod"];


?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes</title>
    <link rel="stylesheet" href="../../View/_css/normalize.css">
    <link rel="stylesheet" href="../../View/_css/MaterialV.css">
    <link rel="stylesheet" href="../../View/_css/addNota.css">
    <!--------------VERIFICACAO DE ERRO-------------------->
    <script type="application/javascript">
        if(<?echo $msg==NULL?0:1?>==1){
            var tipo = <?echo $tipo?>;
            var msg = <?echo "\"$msg\""?>;
            var cod = <?echo $cod?>;
            if(tipo==1){
                alert(msg+"\nerro["+cod+"]");
            }else{
                alert(msg+"\naviso["+cod+"]");
            }
        }
    </script>
    <!--------------VERIFICACAO DE ERRO-------------------->
</head>
<body>
<header class="shadow-base display-r">
    <img src="../../View/_img/icon_background.png" alt="">
</header>
<main class="display-r">
    <form  method="POST" action="./../../Controller/adicionar_nota/">
    <div id="container-formulario" class="display-c">
        <div id="container-input-formulario" class="display-c">
            <input type="text" name="nome" placeholder="Nome" class="input-item border-y">
            <input type="date" name="data" class="input-item center border-y" >
            <textarea name="descricao" class="input-item" placeholder="Descrição"></textarea>
            <button type="submit" class="color-white border-round border-none background-green">Adicionar Nota</button>
        </div>
    </div>
    </form>
</main>
</body>
</html>