<?php

class Logger{


    public function addLogErro($texto){
        if (!file_exists(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Logs')) {
            if (!is_writable(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR)) {
                return -1;
            }
            mkdir(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Logs', 0755, true);
        }else if (!is_writable(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Logs')) {
            return -1;
        }
        $this->addLog(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."Logs/WebServiceErros.log", $texto);
    }
    public function addLogRoot($texto){
        $this->addLog(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."root.log", $texto);
    }
    private function addLog($path, $texto){
        date_default_timezone_set("America/Sao_Paulo");
        $data = date('Y-m-d H:i:s');
        $ip = $_SERVER["REMOTE_ADDR"];
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $ip."/".$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	

        $logPath = $path;
        $logFile = fopen($logPath, "a+");
        $linha = $data." -> [".$ip."] ".$texto;
        $linha = $linha."\r\n";
        fwrite($logFile, $linha);
        fclose($logFile);
    }

}

?>