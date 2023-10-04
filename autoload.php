<?php

    spl_autoload_register(function($clase){

        $archivo= __DIR__."/".$clase.".php";
        $archivo=str_replace("\\","/",$archivo);//Evita fallas en servidores linux

        if(is_file($archivo)){
            require_once $archivo;
        } 
    });