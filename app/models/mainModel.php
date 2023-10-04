<?php
    namespace app\models;
    use \PDO;
    

    if(file_exists(__DIR__."/../../config/setting.php")){
        require_once __DIR__."/../../config/setting.php";
    }

    class mainModel{
      

        private $conector = null;

        protected function getConexion() {
            try {
                $this->conector = new PDO("sqlsrv:server=".SERVIDOR.";database=".DATABASE, USUARIO, PASSWORD);
                $this->conector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                
                return $this->conector;
            } catch (PDOException $e) {
                die("Error al conectarse a la base de datos: " . $e->getMessage());
            }
        }

        public function closeConexion() {
            $this->conector = null;
        }
        protected function ejecutarConsulta($consulta){
            $sql=$this->getConexion()->prepare($consulta);     
            $sql->execute();
        }

        public function limpiarCadena($cadena){ //Filtro inyeccion sql


            $palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			foreach($palabras as $palabra){
				$cadena=str_ireplace($palabra, "", $cadena);
			}

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			return $cadena;
        }

        protected function verificarDatos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/", $cadena)){
				return false;
            }else{
                return true;
            }
        }

        protected function guardarDatos($tabla,$datos){

			$query="INSERT INTO $tabla (";

			$C=0;
			foreach ($datos as $clave){
				if($C >= 1){ $query.= ","; }
				$query.= $clave["campo_nombre"];
				$C++;
			}
			
			$query.= ") VALUES (";

			$C=0;
			foreach ($datos as $clave){
				if($C >=1 ){ $query.= ","; }
				$query .= $clave["campo_marcador"];
				$C++;
			}

			$query .= ")";
			$sql=$this->getConexion()->prepare($query);

			foreach ($datos as $clave){
				$sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
			}

			$sql->execute();

			return $sql;
		}

        public function seleccionarDatos($tipo, $tabla, $campo, $id){
            $tipo = $this->limpiarCadena($tipo);
            $tabla = $this->limpiarCadena($tabla);
            $campo = $this->limpiarCadena($campo);
            $id = $this->limpiarCadena($id);

            if($tipo == "Unico"){
                $sql=$this->getConexion()->prepare("SELECT * FROM $tabla WHERE
                $campo =:ID");
                $sql->bindParam(":ID",$id);
            }elseif($tipo=="Normal"){
                $sql=$this->getConexion()->prepare("SELECT $campo FROM $tabla");
            }
            $sql->execute();

            return $sql;
        }

        protected function actualizarDatos($tabla, $datos, $condicion){
            $query="UPDATE $tabla SET ";
            $C=0;
            foreach ($datos as $clave) {
                if($C>=1){$query.=",";}
                $query.=$clave["campo_nombre"]."=".$clave["campo_marcador"];
                $C++;
            }

            $query.=" WHERE ".$condicion["condicion_campo"]."=".$condicion["condicion_marcador"];

            $sql=$this->getConexion()->prepare($query);

            foreach ($datos as $clave){
                $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
            }

            $sql->bindParam($condicion["condicion_marcador"],$condicion["condicion_valor"]);

            $sql->execute();

            return $sql;
        }

        protected function eliminarRegistro($tabla,$campo,$id){
            $sql=$this->getConexion()->prepare("DELETE FROM $tabla WHERE $campo=:id");
            $sql->bindParam(":id",$id);

            $sql->execute();

            return $sql;
        }

        protected function paginadorTablas($pagina,$numPaginas,$url,$botones){

            $tabla='<nav class="pagination is-centered is-rounded" role="navigation" 
            aria-label="pagination">';

            if($pagina<=1){
                $tabla.='
                <a class="pagination-previous is-disabled" disabled >Anterior</a>
                <ul class="pagination-list">
                ';
            }else{
                $tabla.='
                <a class="pagination-previous" href="'.$url.($pagina-1).'/
                ">Anterior</a>
                <ul class="pagination-list">
                    <li><a class="pagination-link" href="'.$url.'1/">1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                ';
            }

            $ci=0;
            for ($i=$pagina; $i <=$numPaginas ; $i++) { 
                if($ci>=$botones){
                    break;
                }

                if($pagina==$i){
                    $tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'/">'.$i.'</a></li>';
                }else{
                    $tabla.='<li><a class="pagination-link" href="'.$url.$i.'/">'.$i.'</a></li>';
                }

                $ci++;
            }

            if($pagina==$numPaginas){
                $tabla.='
                </ul>
                <a class="pagination-next is-disabled" disabled >Siguiente</a>
                ';
            }else{
                $tabla.='
                    <li><span class="pagination-ellipsis">&hellip;</span></li>  
                    <li><a class="pagination-link" href="'.$url.$numPaginas.'/">'.$numPaginas.'</a></li>
                </ul>
                <a class="pagination-next" href="'.$url.($pagina+1).'/">Siguiente</a>
                ';
            }
            $tabla.='</nav>';

            return $tabla;
        }
    }

?>
