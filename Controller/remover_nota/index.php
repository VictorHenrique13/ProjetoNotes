<?php

require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/post_it.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/erro.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/aviso.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../library/post_utils.php";

$page_retorno = "./../../View/notas/";

$pk_post = "pk_post";

$retorno_util = getVerifyIssetEmpty($pk_post);

if($retorno_util==-1){
    $erro = new Erro(4);
    $erro->sendPostTo($page_retorno);
}else if ($retorno_util==-2){
    $aviso = new Aviso(7);
    $aviso->sendPostTo($page_retorno);
}else{
    $pk_post = $retorno_util[$pk_post];
}

try{
    $retorno = Post_It::remove($pk_post);

    if($retorno==-1){
        $aviso = new Aviso(10);
        //print($aviso->get()->getMessage());
        $aviso->sendPostTo($page_retorno);
    }else if($retorno==1){
        $aviso = new Aviso(9);
        //print($aviso->get()->getMessage());
        //$aviso->sendPostTo($page_retorno);
        header("Location: $page_retorno");
        exit;
    }else{
        $erro = new Erro(5);
        //print($aviso->get()->getMessage());
        $erro->sendPostTo($page_retorno);
    }

}catch(Exception $e){
    $erro = new Erro(5);
    $erro->sendPostTo($page_retorno);
}