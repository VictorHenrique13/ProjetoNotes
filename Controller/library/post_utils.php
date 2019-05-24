<?php

function getVerifyIsset(...$params){
    $retorno = array();
    foreach ($params as $param){
        if(isset($_POST[$param])){
            $retorno[$param]=$_POST[$param];
        }else{
            return -1;
        }
    }
    return $retorno;
}

function getVerifyIssetEmpty(...$params){
    $retorno = array();
    $algumVazio = false;
    foreach ($params as $param){
        if(isset($_POST[$param])){
            $a = $_POST[$param];
            $retorno[$param]=$a;
            if(empty($a)){
                $algumVazio=true;
            }
        }else{
            return -1;
        }
    }
    if($algumVazio==true){
        return -2;
    }
    return $retorno;
}
