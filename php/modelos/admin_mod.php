<?php

require '../config/configdb.php';
class UserModel {

    private $mysqli;

    public function __construct() {
        $this->establecerConexion();
    }

    private function establecerConexion() {
        $host = constant('HOST');
        $bdname = constant('BDNAME');
        $usuario = constant('USERNAME');
        $passwd = constant('PASSWD');

        $this->mysqli = new mysqli($host, $usuario, $passwd, $bdname);

        if ($this->mysqli->connect_error) {
            die("Error de conexión: " . $this->mysqli->connect_error);
        }

        $this->mysqli->set_charset("utf8");
    }

    public function cerrarConexion() {
        if ($this->mysqli) {
            mysqli_close($this->mysqli);
        }
    }

    public function getUserByUsername($username) {
        $stmt = $this->mysqli->prepare("SELECT id, username, passwd, perfil FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc(); // Devuelve los datos del usuario si existe, o null si no existe
    }
}

?>
