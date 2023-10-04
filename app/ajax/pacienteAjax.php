<?php
    require_once "../../config/app.php";
    require_once "../views/inc/sesion_start.php";
    require_once "../../autoload.php";

    use app\controllers\pacienteController;

    if(isset($_POST['modulo_usuario'])){//verifica si llega correctamente por el modulo de userNew-view

        $insPaciente = new pacienteController();

        if($_POST['modulo_usuario']=="registrar"){
            echo $insPaciente->registrarPacienteController();
        }

    }else{//en caso no llegue correctamente destruye las sesiones que esten activas
        session_destroy();
        header("Location: ".APP_URL."login/");
    }

?>