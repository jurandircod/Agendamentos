<?php

 class paineis{
    public $painelUser = "Painel de controle do usuario";
    public $loginUser = "Entre com a sua conta";
    public $painelAdmin = "Painel de controle do admin";


    function painelUser(){
        if(!isset($_SESSION)){
            session_start();
        }
        echo $_SESSION["nome"];
    }
    function painelAdmin(){
        echo $this->painelAdmin;
    }
    function loginUser(){
        echo $this->loginUser;
    }
}

?>