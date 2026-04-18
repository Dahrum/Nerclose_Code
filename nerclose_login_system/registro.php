<?php
include("con_db.php");

if (isset($_POST['register'])) {

    if (
        strlen($_POST['usuario']) >= 1 &&
        strlen($_POST['codigo']) >= 1 &&
        strlen($_POST['correo']) >= 1 &&
        strlen($_POST['contraseña']) >= 1
    ) {

        $usuario = trim($_POST['usuario']);
        $codigo = trim($_POST['codigo']);
        $correo = trim($_POST['correo']);
        $contraseña = trim($_POST['contraseña']);

        $verificar = "SELECT * FROM datos WHERE usuario='$usuario'";
        $resultado_verificar = mysqli_query($conex, $verificar);

        if (mysqli_num_rows($resultado_verificar) > 0) {

            $mensaje = "El usuario ya existe";

        } else {

            $consulta = "INSERT INTO datos(usuario, codigo_institucion, correo, contraseña, fecha_reg)
                         VALUES ('$usuario','$codigo','$correo','$contraseña', NOW())";

            $resultado = mysqli_query($conex, $consulta);

            if ($resultado) {
                $mensaje = "Registro exitoso";
            } else {
                $mensaje = "Error al registrar";
            }
        }

    } else {
        $mensaje = "Completa todos los campos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles.css">
<title>Registro</title>
</head>
<body>

<div class="login-contenedor">
<form class="login-caja" method="post">

<h2>Registro</h2>

<input type="text" name="usuario" placeholder="Usuario">
<input type="text" name="codigo" placeholder="Código institución">
<input type="email" name="correo" placeholder="Correo">
<input type="password" name="contraseña" placeholder="Contraseña">

<input type="submit" name="register" value="Registrarse">

<?php 
if (isset($mensaje)) {
    if ($mensaje == "Registro exitoso") {
        echo "<p class='ok'>$mensaje</p>";
    } else {
        echo "<p class='bad'>$mensaje</p>";
    }
}
?>

<p><a href="login.php">Volver al login</a></p>

</form>
</div>

</body>
</html>