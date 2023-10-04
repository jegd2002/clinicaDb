<?php

    namespace app\controllers;
    use app\models\mainModel;

    class pacienteController extends mainModel{
        # Controller registro de nuevo paciente 
        public function registrarPacienteController(){

             //Almacen datos
             $nombre=$this->limpiarCadena($_POST['usuario_nombre']);
             $edad=$this->limpiarCadena($_POST['usuario_edad']);
             $genero=$this->limpiarCadena($_POST['usuario_genero']);
             $departamento=$this->limpiarCadena($_POST['usuario_departamentoID']);
             $municipio=$this->limpiarCadena($_POST['usuario_municipioID']);
             $documento=$this->limpiarCadena($_POST['usuario_documento']);
             $usuario=$this->limpiarCadena($_POST['usuario_usuario']);
             $clave1=$this->limpiarCadena($_POST['usuario_clave_1']);
             $clave2=$this->limpiarCadena($_POST['usuario_clave_2']);

             
    
             //Verificacion campos obligatorios
             if($nombre==""||$edad=="" || $genero==""||$departamento==""||$municipio==""||$documento==""||$usuario==""||$clave1==""||$clave2==""){
                 $alerta=[
                     "tipo"=>"simple",
                     "titulo"=>"Ocurrió un error inesperado",
                     "texto"=>"No has llenado todos los campos que son obligatorios",
                     "icono"=>"error"
                 ];
                 return json_encode($alerta);
             exit(); 
            }
            //Verificacion integridad
            if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El Nombre no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }
            //Verificacion edad
            if($this->verificarDatos("[0-9]{0,3}",$edad)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"La edad no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }
            //Verificacion genero
            if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,15}",$genero)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El genero no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }
           
            //Verificacion Documento
            if($this->verificarDatos("[0-9]{4,20}",$documento)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El Nombre no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }

             //Verificacion usuario
            if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El usuario no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }

            //Verificacion clave
            if($this->verificarDatos("[a-zA-Z0-9]{7,100}",$clave1)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"la clave no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }

            //Verificacion clave2
            if($this->verificarDatos("[a-zA-Z0-9]{7,100}",$clave2)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"la clave no tiene los parametros requeridos",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
            exit(); 
            }
            /*
            //para verificar email en caso de ser necesario
            if($email != ""){
                if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $check_email=$this->ejecutarConsulta("SELECT email FROM ClinicaDB WHERE email ='$email'");

                    if($check_email->rowCount()>0){
                        $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrió un error inesperado",
                        "texto"=>"El correo que ingreso ya se encuentra registrado",
                        "icono"=>"error"
                        ];
                        return json_encode($alerta);
                    exit();
                    }
                }else{
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrió un error inesperado",
                        "texto"=>"Email no valido",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                exit();
                }
            }
            */

            //Verificar que las claves ingresadas sean iguales
            if($clave1 != $clave2){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"Las claves no coinciden, ingrese nuevamente",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }else{
                //$clave=password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);//Encriptar clave
                $clave=$clave1;//Encriptar clave
            }
            
            

        $paciente_datos=[
            [
                "campo_nombre"=>"nombre",
                "campo_marcador"=>":Nombre",
                "campo_valor"=>$nombre
            ],
            [
                "campo_nombre"=>"edad",
                "campo_marcador"=>":Edad",
                "campo_valor"=>$edad
            ],
            [
                "campo_nombre"=>"genero",
                "campo_marcador"=>":Genero",
                "campo_valor"=>$genero
            ],
            [
                "campo_nombre"=>"departamento",
                "campo_marcador"=>":DepartamentoID",
                "campo_valor"=>$departamento
            ],
            [
                "campo_nombre"=>"municipio",
                "campo_marcador"=>":MunicipioID",
                "campo_valor"=>$municipio
            ],
            [
                "campo_nombre"=>"documento",
                "campo_marcador"=>":Documento",
                "campo_valor"=>$documento
            ],
            [
                "campo_nombre"=>"usuario",
                "campo_marcador"=>":Usuario",
                "campo_valor"=>$usuario
            ],
            [
                "campo_nombre"=>"password",
                "campo_marcador"=>":Password",
                "campo_valor"=>$clave
            ],
        ];

        $registrar_paciente=$this->guardarDatos("pacientes",$paciente_datos);

        
        if ($registrar_paciente->rowCount() == 1) {
            $alerta=[
                "tipo"=>"limpiar",
                "titulo"=>"Usuario registrado",
                "texto"=>"El usuario ".$nombre." se registro con exito",
                "icono"=>"success"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"No se pudo registrar el usuario, por favor intente nuevamente",
                "icono"=>"error"
            ];
            return json_encode($alerta);
           exit();
        }
        
        return json_encode($alerta);

    }

    public function listarUsuarioControlador($pagina,$registros,$url,$busqueda){

        $pagina=$this->limpiarCadena($pagina);
		$registros=$this->limpiarCadena($registros);

        $url=$this->limpiarCadena($url);
        $url=APP_URL.$url."/";

        $busqueda=$this->limpiarCadena($busqueda);
        $tabla="";

        $pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
        $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

        if(isset($busqueda) && $busqueda!=""){
            
            $consulta_datos="SELECT * FROM pacientes WHERE ((pacienteid!='".$_SESSION['id']."' AND pacienteid!='1') AND (nombre LIKE '%$busqueda%' OR edad LIKE '%$busqueda%' OR genero LIKE '%$busqueda%' OR departamento LIKE '%$busqueda%' OR municipio LIKE '%$busqueda%' OR documento LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR password LIKE '%$busqueda%')) ORDER BY nombre ASC LIMIT $inicio,$registros";

			$consulta_total="SELECT COUNT(pacienteid) FROM pacientes WHERE ((pacienteid!='".$_SESSION['id']."' AND pacienteid!='1') AND (nombre LIKE '%$busqueda%' OR edad LIKE '%$busqueda%' OR genero LIKE '%$busqueda%' OR departamento LIKE '%$busqueda%' OR municipio LIKE '%$busqueda%' OR documento LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR password LIKE '%$busqueda%'))";

        }else{

            $consulta_datos="SELECT * FROM pacientes WHERE pacienteid!='".$_SESSION['id']."' AND pacienteid!='1' ORDER BY nombre ASC LIMIT $inicio,$registros"; //obtiene los registros de pacientes que coinciden con la búsqueda

			$consulta_total="SELECT COUNT(pacienteid) FROM usuario WHERE pacienteid!='".$_SESSION['id']."' AND pacienteid!='1'"; //Cuenta el numero de de registros que coincide

        }

        $datos = $this->ejecutarConsulta($consulta_datos);
		$datos = $datos->fetchAll();

        $total = $this->ejecutarConsulta($consulta_total);
		$total = (int) $total->fetchColumn();

        $numeroPaginas =ceil($total/$registros); //ceil redondea hacia arriba

        $tabla.='
            <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                    <th class="has-text-centered">#</th>
                    <th class="has-text-centered">Nombre</th>
                    <th class="has-text-centered">Edad</th>
                    <th class="has-text-centered">Género</th>
                    <th class="has-text-centered">Departamento</th>
                    <th class="has-text-centered">Municipio</th>
                    <th class="has-text-centered">Documento</th>
                    <th class="has-text-centered">Usuario</th>
                    <th class="has-text-centered">Contraseña</th>
                    <th class="has-text-centered" colspan="3">Opciones</th>
                    </tr>
                </thead>
                <tbody>
        ';

        if($total>=1 && $pagina<=$numeroPaginas){
            $contador=$inicio+1;
            $pag_inicio=$inicio+1;
            foreach($datos as $rows){
                $tabla.='
                    <tr class="has-text-centered" >
                        <td>'.$contador.'</td>
                        <td>'.$rows['nombre'].'</td>
                        <td>'.$rows['edad'].'</td>
                        <td>'.$rows['genero'].'</td>
                        <td>'.$rows['departamento'].'</td>
                        <td>'.$rows['municipio'].'</td>
                        <td>'.$rows['documento'].'</td>
                        <td>'.$rows['usuario'].'</td>
                        <td>'.$rows['password'].'</td>
                    <td>
                        <a href="'.APP_URL.'userUpdate/'.$rows['pacienteid'].'/" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <form class="FormularioAjax" action="'.APP_URL.'app/ajax/usuarioAjax.php" method="POST" autocomplete="off" >

                            <input type="hidden" name="modulo_usuario" value="eliminar">
                            <input type="hidden" name="pacienteid" value="'.$rows['pacienteid'].'">

                            <button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
                        </form>
                    </td>
                </tr>
            ';
            $contador++;
        }
        $pag_final=$contador-1;
        }else{
            if($total>=1){
                $tabla.='
                    <tr class="has-text-centered" >
                        <td colspan="7">
                            <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            }else{
                $tabla.='
                    <tr class="has-text-centered" >
                        <td colspan="7">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
            }

        }
        $tabla.='</tbody></table></div>';

			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,7); 
			}

			return $tabla;

    }
}
?>