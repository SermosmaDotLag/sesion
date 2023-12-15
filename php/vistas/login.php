<?php
session_start();

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $perfil;

    require_once 'php/modelos/admin_mod.php';

    // Instanciar el modelo de usuario
    $userModel = new UserModel();

    // Verificar si el usuario existe en la base de datos
    $usuario = $userModel->getUserByUsername($username);

    
}
?>

<!-- Formulario de inicio de sesión -->
<form method="post" action="#">
    <label for="username">Usuario:</label>
    <input type="text" name="username" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Iniciar sesión</button>
</form>

<!-- Mostrar mensaje después de enviar el formulario -->
<?php
    if ($_SESSION['perfil'] == 0) {
        // Usuario autenticado, establecer la sesión del usuario
        require_once 'php/vistas/juego1.php';

         $_SESSION['user_id'] = $usuario['id'];
         $_SESSION['username'] = $usuario['username'];
         $_SESSION['perfil'] = $usuario['perfil'];
         $mensaje = '<br>Inicio de sesión exitoso <br>Has iniciado sesion como el usuario:'
             .$_SESSION['username'].'<br>Tu perfil es :'.$_SESSION['perfil'];
    } else {
        $mensaje = 'Usuario o contraseña incorrectos';
    }

    // Cerrar la conexión a la base de datos
    $userModel->cerrarConexion();


    echo $mensaje; 
?>
