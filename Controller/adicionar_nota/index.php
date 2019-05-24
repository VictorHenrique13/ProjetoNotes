<?php

require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/post_it.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/erro.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../../Model/aviso.php";
require_once __DIR__.DIRECTORY_SEPARATOR."../library/post_utils.php";

$page_retorno = "./../../View/adicionar_nota/";
$page_sucesso = "./../../View/notas/";

$nome = "nome";
$descricao = "descricao";
$data = "data";

$retorno_util = getVerifyIssetEmpty($nome,$descricao,$data);

if($retorno_util==-1){
    $erro = new Erro(4);
    $erro->sendPostTo($page_retorno);
}else if ($retorno_util==-2){
    $aviso = new Aviso(7);
    $aviso->sendPostTo($page_retorno);
}else{
    $nome = $retorno_util[$nome];
    $descricao = $retorno_util[$descricao];
    $data = $retorno_util[$data];
}

try{
    $post = new Post_It($nome,$data,$descricao);
    $retorno = $post->cadastrar();

    if($retorno==-1){
        $aviso = new Aviso(8);
        //print($aviso->get()->getMessage());
        $aviso->sendPostTo($page_retorno);
    }else if($retorno==1){
        $aviso = new Aviso(9);
        //print($aviso->get()->getMessage());
       // $aviso->sendPostTo($page_sucesso);
        header("Location: $page_sucesso");
    }else{
        $erro = new Erro(5);
        //print($aviso->get()->getMessage());
        $erro->sendPostTo($page_retorno);
    }

}catch(Exception $e){
    $erro = new Erro(5);
    $erro->sendPostTo($page_retorno);
}