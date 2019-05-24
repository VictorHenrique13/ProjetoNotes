<?php


class Erro{
    private $erro = array();

    function __construct($n) {
        switch($n){
            case 1:
                $this->erro = array('erro' => array('cod' => 1, 'msg' => 'nao foi possivel conectar no banco de dados'));
                break;
            case 2:
                $this->erro =  array('erro' => array('cod' => 2, 'msg' => 'sem comando'));
                break;
            case 3:
                $this->erro = array('erro' => array('cod' => 3 ,'msg' => 'comando nao encontrado'));
                break;
            case 4:
                $this->erro = array('erro' => array('cod' => 4, 'msg' => 'parametros insuficientes'));
                break;
            case 5:
                $this->erro = array('erro' => array('cod' => 5, 'msg' => 'erro desconhecido'));
                break;
            case 6:
                $this->erro = array('erro' => array('cod' => 6, 'msg' => 'mysql error'));
                break;
            case 7:
                $this->erro = array('erro' => array('cod' => $n, 'msg' => 'parametro nulo'));
                break;
        }
    }
    function get(){
        return $this->getException();
    }
    function getHtml(){
        $retorno = '<!DOCTYPE html><html lang="pt-br">';
        $retorno.=$this->erro["erro"]["msg"]."\nerro[".$this->erro["erro"]["cod"]."]";
        return $retorno;
    }
    function getJson(){
        return json_encode($this->erro);
    }
    function getArray(){
        return $this->erro;
    }
    function sendPostTo($link){
        $msg = $this->erro["erro"]["msg"];
        $cod = $this->erro["erro"]["cod"];
        echo '
        <form id="myForm" action="'.$link.'" method="post">
        <input type="hidden" name="erro" value="'.$msg.'">
        <input type="hidden" name="cod" value="'.$cod.'">
        </form>
        <script type="text/javascript">
            document.getElementById(\'myForm\').submit();
        </script>';
        die();
    }
    function getException(){
        $msg = $this->erro["erro"]["msg"];
        $cod = $this->erro["erro"]["cod"];
        return new Exception($msg,$cod);
    }
}

?>