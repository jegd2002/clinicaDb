
<?php
/*require 'setting.php';

class Connection {
    private $conector = null;

    public function getConexion() {
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
}

$con = new Connection();
$db = $con->getConexion();

if ($db) {
    echo "Conexión Exitosa";
    
    $con->closeConexion(); 
} else {
    echo "Error al conectarse a la base de datos";
}
*/
?>