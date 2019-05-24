<?php
include_once __DIR__.DIRECTORY_SEPARATOR."../../Model/post_it.php";
include_once __DIR__.DIRECTORY_SEPARATOR."../../Controller/library/aviso_erro.php";
$aviso_erro = buscarErroOuAviso();
$msg = $aviso_erro["msg"];$tipo= $aviso_erro["tipo"];$cod = $aviso_erro["cod"];
/*
$retorno = verificarToken(2);
$nome=NULL;
if(!isset($retorno['nome'])){
    header("Location: ./../../");
    die();
}else{
    $nome=$retorno['nome'];
}
 */

#######################################
$tabela_post = Post_It::tabelas["post"]["nome"];
$pk_post_column = Post_It::tabelas["post"]["coluna"]["pk_post"];
$nome_column = Post_It::tabelas["post"]["coluna"]["nome"];
$texto_column = Post_It::tabelas["post"]["coluna"]["texto"];
$data_column = Post_It::tabelas["post"]["coluna"]["data"];
$posts = Post_It::listar();
if($posts==-1||empty($posts)){
    header("Location: ./../../");
}
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
    <link rel="stylesheet" href="../../View/_css/notas.css">
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

<main class="display-c">
    <form id="add_nota_form" method="post" action="./../adicionar_nota/"> </form>
    <form id="delete_post_form" method="post" action="./../../Controller/remover_nota/"> </form>
    <div id="container-cards" class="display-c-not">
        <?php
        if($posts&&$posts!=-1&&!empty($posts)&&sizeof($posts)>0){
            foreach ($posts as $post) {
                $pk_post = $post[$pk_post_column];
                $nome = $post[$nome_column];
                $data = $post[$data_column];
                $descricao = $post[$texto_column];
                $texto=
                    " <div class=\"card border-round\">
            <header class=\"title\">$nome</header>
            <div class=\"content \">$descricao</div>
            <div class=\"display-r foo-g\">
                <div class=\"foot-l\">
                    $data
                </div>
                <label for = 'input_delete' class=\"foot-r\">Deletar</label>
                <input onclick='this.form.submit()' id='input_delete' type='radio' name='pk_post' value='$pk_post' form='delete_post_form' style='display: none;'>
            </div>
                    </div>";
                echo $texto;
            }
        }
        ?>


    </div>
    <footer class="display-r">
        <button form="add_nota_form" type="submit" class="color-white border-round border-none background-green">Adicionar Nota</button>
    </footer>

</main>
</body>
</html>