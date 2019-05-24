<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'../../Model/erro.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../../Model/logger.php';

/**
 * Class DbOff
 * @ignore Igonarar código, apenas para teste
 */
class DbOff{
    public function selecionarBancoDeDados($db){
    }
    public function mandarQuery($sql){
        $retorno = 0;
        return $retorno;
    }
    public function pegarQuery($sql){
        $retorno = array();
        return $retorno;
    }
}

class Db{
    /**
     * @var Db $db
     */
    public static $db = NULL;
    //private $servername = "br360.hostgator.com.br";
    //private $username = "vipho314_sandbox";
    //private $password = "sandteste";
    //private $dbName = "vipho314_sandbox";

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "test";
    private $conn = NULL;

    function __construct() {
        $this->conn = $this->obterConexao();
		//DB ja foi selecionado no PDO
    }
    public static function inicializar(){
        self::$db = new Db();
    }
    private function obterConexao(){
		$conn = NULL;
		try{
			$conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
            $erro = new Erro(1);
            $logger = new Logger;
            $logger->addLogErro("nao conectou mysql: ".$e->getMessage());
            Db::$db=new DbOff();
            $erro->sendPostTo("./../");
            //throw $erro->get();
		}
		return $conn;
    }

    public function selecionarBancoDeDados($db){
		try{
			$this->conn->exec("use $db");
		}catch(PDOException $e){
            //header('Content-type: application/json');
            $erro = new Erro(6);
            $logger = new Logger;
            $logger->addLogErro("mysql error: ".$e->getMessage());
            return -1;
		}
    }
    public function mandarQuery($sql){
        if($this->conn==NULL) return 0;
		$retorno = NULL;
		try{
			$retorno = $this->conn->exec($sql);
		}catch(PDOException $e){
            //header('Content-type: application/json');
            $erro = new Erro(6);
            $logger = new Logger;
            $logger->addLogErro("mysql error: ".$e->getMessage());
            return -1;
		}
		return $retorno;
    }
    public function pegarQuery($sql){
        if($this->conn==NULL) return array();
		$retorno = NULL;
		try{
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
            //header('Content-type: application/json');
            $erro = new Erro(6);
            $logger = new Logger;
            $logger->addLogErro("mysql error: ".$e->getMessage());
            return array();
		}
        return $retorno;
    }
}
Db::$db=new Db();
?>