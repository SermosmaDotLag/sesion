<?php
require_once 'php/modelos/admin_mod.php';

class Admin_con {
    public $vista = "login";
    public function __construct() {
        // Puedes inicializar cosas aquí si es necesario
    }

    public function mostrarDashboard() {
        require '../vistas/login.php';
        return array();
    }

    public function procesarInicioSesion($username, $password) {
        $userModel = new UserModel();
        $usuario = $userModel->getUserByUsername($username);
    
        // Cerrar la conexión a la base de datos después de obtener el usuario
        $userModel->cerrarConexion();
    
        if ($usuario && $password === $usuario['passwd']) {
            // Usuario autenticado, establecer la sesión y redirigir a la página principal
            session_start();
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['perfil'] = $usuario['perfil'];
    
            // Redirigir a un controlador y método específicos para el panel de administración
            header('Location: index.php?control=admin_con&metodo=mostrarDashboard');
            exit();
        } else {
            // Usuario no autenticado, redirigir al formulario de inicio de sesión con un mensaje de error
            header('Location: php/vistas/login.php?error=Usuario o contraseña incorrectos');
            exit();
        }
    }
}
?>