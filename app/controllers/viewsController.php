<?php
    namespace app\controllers;
    use app\models\viewsModel;

    class viewsController extends viewsModel{
        
        public function obtenerViewController($vista){
            if($vista !=""){
                $respuesta=$this-> obtenerViewModel($vista);
            }else{
                $respuesta="login";
            }
            return $respuesta;
        }
    }


?>