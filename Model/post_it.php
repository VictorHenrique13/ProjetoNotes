<?php

require_once __DIR__.DIRECTORY_SEPARATOR."../Controller/library/db.php";

class Post_It{
    private $nome;
    private $data;
    private $descricao;

    const tabelas = array(
        "post"=>array(
            "nome"=>"post",
            "coluna"=>array(
                "pk_post"=>"pk_post",
                "nome"=>"nome",
                "texto"=>"texto",
                "data"=>"data"
            )
        )


    );

    public function __construct($nome,$data,$descricao)
    {
        $this->nome=$nome;
        $this->data=$data;
        $this->descricao=$descricao;
    }


    public function cadastrar(){
        $tabela_post = Post_It::tabelas["post"]["nome"];
        $pk_post_column = Post_It::tabelas["post"]["coluna"]["pk_post"];
        $nome_column = Post_It::tabelas["post"]["coluna"]["nome"];
        $texto_column = Post_It::tabelas["post"]["coluna"]["texto"];
        $data_column = Post_It::tabelas["post"]["coluna"]["data"];

        $sql = "insert into $tabela_post ($nome_column,$texto_column,$data_column) values
                ('$this->nome','$this->descricao','$this->data')";

        $retorno = Db::$db->mandarQuery($sql);

        if($retorno==-1){
            return -1;
        }else{
            return 1;
        }
    }

    public static function listar(){
        $tabela_post = Post_It::tabelas["post"]["nome"];
        $pk_post_column = Post_It::tabelas["post"]["coluna"]["pk_post"];
        $nome_column = Post_It::tabelas["post"]["coluna"]["nome"];
        $texto_column = Post_It::tabelas["post"]["coluna"]["texto"];
        $data_column = Post_It::tabelas["post"]["coluna"]["data"];

        $sql = "select 
                $pk_post_column,
                $nome_column,
                $data_column,
                $texto_column
                from $tabela_post";

        $retorno = Db::$db->pegarQuery($sql);

        if($retorno&&!empty($retorno)&&sizeof($retorno)>0){
            return $retorno;
        }else{
            return -1;
        }
    }

    public static function remove($pk_post){
        $tabela_post = Post_It::tabelas["post"]["nome"];
        $pk_post_column = Post_It::tabelas["post"]["coluna"]["pk_post"];
        $sql = "delete from $tabela_post where $pk_post_column = $pk_post";

        $retorno = Db::$db->mandarQuery($sql);

        if($retorno == -1){
            return -1;
        }else{
            return 1;
        }
    }
}