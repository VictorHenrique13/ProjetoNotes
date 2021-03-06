<?php
include_once __DIR__.DIRECTORY_SEPARATOR."Controller/library/aviso_erro.php";
include_once __DIR__.DIRECTORY_SEPARATOR."Model/post_it.php";
$aviso_erro = buscarErroOuAviso();
$msg = $aviso_erro["msg"];$tipo= $aviso_erro["tipo"];$cod = $aviso_erro["cod"];


$tabela_post = Post_It::tabelas["post"]["nome"];
$pk_post_column = Post_It::tabelas["post"]["coluna"]["pk_post"];
$nome_column = Post_It::tabelas["post"]["coluna"]["nome"];
$texto_column = Post_It::tabelas["post"]["coluna"]["texto"];
$data_column = Post_It::tabelas["post"]["coluna"]["data"];
$posts = Post_It::listar();
if(!($posts==-1||empty($posts))){
    header("Location: ./View/notas/");
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes</title>    <link rel="stylesheet" href="View/_css/normalize.css">
    <link rel="stylesheet" href="View/_css/MaterialV.css">
    <link rel="stylesheet" href="View/_css/home.css">
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
<header class="display-r shadow-base">
    <img src="View/_img/icon_background.png" alt="">
</header>
<main class="display-c">
    <form method="post" action="./View/adicionar_nota/">
    <div id="container-card-home" class="display-c">
        <div id="img-card-home-initial">
            <img src="View/_img/icon_background.png" alt="Notes">
        </div>
        <div id="description-card-home">Ora ora não temos nada por aqui....</div>

        <button type="submit" class="color-white border-round border-none background-green">Adicionar Nota</button>
    </form>
    </div>
</main>
</body>
</html>