<?php


function buscarErroOuAviso(){
    $msg = NULL;
    $tipo= 0;
    $cod = 0;
    if(isset($_POST['erro'])&&isset($_POST['cod'])){
        $msg=$_POST['erro'];
        $cod=$_POST['cod'];
        $tipo=1;
    }
    if(isset($_POST['aviso'])&&isset($_POST['cod'])){
        $msg=$_POST['aviso'];
        $cod=$_POST['cod'];
        $tipo=2;
    }
    return array("msg"=>$msg, "tipo"=>$tipo, "cod"=>$cod);
}