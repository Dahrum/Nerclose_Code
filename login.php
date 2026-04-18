<?php
include("con_db.php");
session_start();

// ACTIVAR ERRORES PARA VER QUÉ PASA
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['login'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['codigo']) && !empty($_POST['correo']) && !empty($_POST['contrasenia'])) {
        
        $usuario = mysqli_real_escape_string($conex, $_POST['usuario']);
        $codigo  = mysqli_real_escape_string($conex, $_POST['codigo']);
        $correo  = mysqli_real_escape_string($conex, $_POST['correo']);
        $password = mysqli_real_escape_string($conex, $_POST['contrasenia']);

        // 1. Verificamos la conexión
        if (!$conex) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $consulta = "SELECT * FROM datos WHERE usuario='$usuario' AND codigo_institucion='$codigo' AND correo='$correo' AND contraseña='$password'";
        $resultado = mysqli_query($conex, $consulta);

        if (!$resultado) {
            die("Error en la consulta SQL: " . mysqli_error($conex));
        }

        if (mysqli_num_rows($resultado) > 0) {
            $_SESSION['usuario'] = $usuario;
            // 2. Verificamos si la sesión se grabó
            if(isset($_SESSION['usuario'])) {
                header("Location: index.php");
                exit();
            } else {
                die("Error: La sesión no se pudo iniciar.");
            }
        } else {
            $error = "No se encontró ningún usuario con esos 4 datos exactos.";
        }
    } else {
        $error = "Faltan campos por llenar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Login de Prueba | Nerclose</title>
</head>
<body class="login-body">
    <div class="login-contenedor">
        <form class="login-caja" method="post">
            <h2>NER<span>CLOSE</span></h2>
            <p style="color: yellow; font-size: 0.8rem;">Modo de depuración activo</p>
            
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="text" name="codigo" placeholder="Código institución" required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contrasenia" placeholder="Contraseña" required>
            
            <input type="submit" name="login" value="PROBAR ACCESO">

            <?php if(isset($error)) echo "<p class='bad'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>