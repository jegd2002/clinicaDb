<?php
    namespace app\controllers;
    use app\models\mainModel;

    require_once "./autoload.php";
    require_once "./config/app.php";

    class loginController extends mainModel{

        //Controlador Iniciar Sesion
        public function iniciarSesionControlador(){

            $usuario=$this->limpiarCadena($_POST['login_usuario']);
            $clave=$this->limpiarCadena($_POST['login_clave']);
            if($usuario==""||$clave=="" ){
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Inesperado',
                            text: 'Hay campos vacios',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
            }else{
                //Verificar datos
                if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Inesperado',
                            text: 'El usario no coincide con lo solicitado',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
                }else{

                    if($this->verificarDatos("[a-zA-Z0-9]{7,100}",$clave)){
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Inesperado',
                                text: 'la clave no coincide con lo solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                    ";
                    }else{
                        $check_usuario=$this->ejecutarConsulta("SELECT * FROM pacientes WHERE usuario='$usuario'");
                        $check_clave=$this->ejecutarConsulta("SELECT * FROM pacientes WHERE password='$clave'");

                        if($check_usuario->rowCount()==1 && $check_clave->rowCount()==1 ){
                            $check_usuario = $check_usuario->fetch();
                            $check_clave = $check_clave->fetch();

                            if($check_usuario['usuario']==$usuario && $check_clave['password'] == $clave){

                                $_SESSION['id'] = $check_usuario['pacienteid'];
                                $_SESSION['nombre'] = $check_usuario['nombre'];
                                $_SESSION['usuario'] = $check_usuario['usuario'];

                                if(headers_sent()){
                                    echo "<script> window.location.href='".APP_URL."dashboard'; </script>";
                                }else{
                                    header("Location: ".APP_URL."/dashboard/");
                                }
                            }else{
                                echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error Inesperado',
                                        text: 'usuario  o clave incorrecto',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                            ";
                            }
                        }else{
                            echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error Inesperado',
                                    text: 'usuario  o clave incorrecto',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";
                        }
                    }
                    
                
                }
            }
        }

    }


?>