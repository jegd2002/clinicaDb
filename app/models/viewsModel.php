<?php
    namespace app\models;

    class viewsModel{

        protected function obtenerViewModel($vista){
            $listWhite = ["dashboard","userNew","userList","userSearch","userUpdate","logOut"];

            if(in_array($vista,$listWhite)){
                if(is_file("./app/views/content/".$vista."-view.php")){
                    $contenido="./app/views/content/".$vista."-view.php";
                }else{
                    $contenido="404";
                }
            }elseif($vista=="login" || $vista=="index"){
                $contenido="login";
            }else{
                $contenido="404";
            }
            return $contenido;
        }
    }

?>