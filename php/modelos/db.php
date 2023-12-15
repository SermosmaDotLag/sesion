<?php

require_once 'php/config/configdb.php';

class Db {

    private $host;
    private $bdname;
    private $usuario;
    private $passwd;
    public $mysqli;

    public function __construct() {
        $this->host = constant('HOST');
        $this->bdname = constant('BDNAME');
        $this->usuario = constant('USERNAME');
        $this->passwd = constant('PASSWD');

        $this->conectar();
    }

    private function conectar() {
        $this->mysqli = new mysqli($this->host, $this->usuario, $this->passwd, $this->bdname);

        if ($this->mysqli->connect_error) {
            die("Error de conexión: " . $this->mysqli->connect_error);
        }

        $this->mysqli->set_charset("utf8");
    }

    public function reconectar() {
        $this->cerrarConexion();
        $this->conectar();
    }

    public function cerrarConexion() {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }

    public function consultar($consulta) {
        $resultado = $this->mysqli->query($consulta);
        if (!$resultado) {
            die("Error en la consulta: " . $this->mysqli->error);
        }
        return $resultado;
    }

    public function escaparString($cadena) {
        return $this->mysqli->real_escape_string($cadena);
    }
}

?>
