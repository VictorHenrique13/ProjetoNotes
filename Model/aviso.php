<?php


class Aviso{
    private $aviso = array();

    function __construct($n) {
        switch($n){
            case 1:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Usuario e(ou) senha incorreto(s)'));
                break;
            case 2:
                $this->aviso =  array('aviso' => array('cod' => $n, 'msg' => 'Arquivo de descrição não é um PDF'));
                break;
            case 3:
                $this->aviso = array('aviso' => array('cod' => $n ,'msg' => 'Arquivo de imagem não é um PNG ou um JPG'));
                break;
            case 4:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Não foi possivel, o produto ja esta cadastrado'));
                break;
            case 5:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Nao foi possivel cadastrar gerador'));
                break;
            case 6:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'mysql error'));
                break;
            case 7:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Campos obrigatorios não podem ficar vazios'));
                break;
            case 8:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Não foi possivel cadastrar Post'));
                break;
            case 9:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Sucesso!!'));
                break;
            case 10:
                $this->aviso = array('aviso' => array('cod' => $n, 'msg' => 'Não foi possivel remover Post'));
                break;
        }
    }
    function get(){
        return $this->getException();
    }
    function getHtml(){
        $retorno = '<!DOCTYPE html><html lang="pt-br">';
        $retorno.=$this->aviso["aviso"]["msg"]."\naviso[".$this->aviso["aviso"]["cod"]."]";
        return $retorno;
    }
    function getJson(){
        return json_encode($this->aviso);
    }
    function getArray(){
        return $this->aviso;
    }
    function sendPostTo($link){
        $msg = $this->aviso["aviso"]["msg"];
        $cod = $this->aviso["aviso"]["cod"];
        echo '
        <form id="myForm" action="'.$link.'" method="post">
        <input type="hidden" name="aviso" value="'.$msg.'">
        <input type="hidden" name="cod" value="'.$cod.'">
        </form>
        <script type="text/javascript">
            document.getElementById(\'myForm\').submit();
        </script>';
        die();
    }
    function getException(){
        $msg = $this->aviso["aviso"]["msg"];
        $cod = $this->aviso["aviso"]["cod"];
        return new Exception($msg,$cod);
    }
}

?>