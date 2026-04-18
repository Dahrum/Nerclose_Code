<?php
session_start();
include("con_db.php");

$error = "";
if (isset($_POST['login'])) {
    // Capturamos los datos usando los nombres exactos de tu base de datos
    // Nota: El 'name' del input ahora debe ser 'contraseña'
    $usuarioInput = mysqli_real_escape_string($conex, $_POST['usuario']);
    $codigoInput  = mysqli_real_escape_string($conex, $_POST['codigo']);
    $correoInput  = mysqli_real_escape_string($conex, $_POST['correo']);
    $passInput    = mysqli_real_escape_string($conex, $_POST['contraseña']);

    // CONSULTA FINAL: Usando tabla 'datos' y tus columnas de la captura
    $consulta = "SELECT * FROM datos WHERE usuario='$usuarioInput' AND contraseña='$passInput' AND codigo_institucion='$codigoInput' AND correo='$correoInput'";
    
    $resultado = mysqli_query($conex, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $_SESSION['usuario'] = $usuarioInput;
        // La redirección automática a 'noticontrol' la hace el script al final
    } else {
        $error = "Acceso denegado. Los datos no coinciden con nuestro registro de seguridad.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css?v=1.2">
    <title>Nerclose | Inicio</title>
    <style>
        .pagina { display: none !important; }
        .pagina.activa { display: block !important; }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Ner<span>close</span></div>
        <ul class="nav-links">
            <li><a href="#" onclick="mostrar('quienes-somos'); return false;">Quiénes somos</a></li>
            <li><a href="#" onclick="mostrar('contacto'); return false;">Contacto</a></li>
            <li><a href="#" onclick="mostrar('el-producto'); return false;">El producto</a></li>
            <li><a href="#" onclick="mostrar('noticontrol'); return false;">Noticontrol</a></li>
            <?php if(isset($_SESSION['usuario'])): ?>
                <li><a href="logout.php" style="color: #ff4d4d;">Cerrar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="pagina activa" id="quienes-somos">
        <p class="titulo-seccion">// Conócenos</p>
        <h1 class="titulo-seccion-grande">Innovación en Seguridad</h1>
        <p>Somos <strong>Nerclose</strong>, una empresa de Cali dedicada a crear soluciones electrónicas para espacios cerrados. Nuestra misión es garantizar procesos seguros y confiables mediante tecnología de punta.</p>
        <div class="grid-2">
            <div class="tarjeta">
                <h3>Nuestra Misión</h3>
                <p>Buscamos desarrollar soluciones tecnológicas accesibles e innovadoras que faciliten el control, registro y monitoreo eficiente del flujo de personas dentro de las instituciones garantizando procesos más organizados, seguros y confiables que contribuyan a mejorar la calidad del servicio y la atención prestada.</p>
            </div>
            <div class="tarjeta">
                <h3>Visión 2030</h3>
                <p>Consolidarnos en el 2030 como la empresa líder de Cali en los espacios, optimizando la gestión del flujo y monitoreo mediante una tecnología sencilla y confiable. Buscamos mejorar la precisión en los registros y fortalecer el control de flujo en diferentes espacios. Aspiramos a ofrecer una solución de fácil implementación y accesible, desarrollada bajo un enfoque sostenible que contribuya a un sistema hospitalario más eficiente, seguro y orientado al futuro.</p>
            </div>
        </div>
    </section>

    <section class="pagina" id="contacto">
        <p class="titulo-seccion">// Red de apoyo</p>
        <h2 class="titulo-seccion-grande">Contáctanos</h2>
        <div class="tarjeta">
            <p>📍 <strong>Ubicación:</strong> Cali, Colombia</p>
            <p>📧 <strong>Email:</strong> nerclose@gmail.com</p>
            <p>📱 <strong>Teléfono:</strong> +57 3027614359</p>
            <p>Estamos en el Colegio Comfandi El Prado listos para atender tus dudas.</p>
        </div>
    </section>

    <section class="pagina" id="el-producto">
        <p class="titulo-seccion">// Nerclose</p>
        <h2 class="titulo-seccion-grande">Nuestro Producto</h2>
        <div class="tarjeta">
            <h3>NotiControl</h3>
            <p>NotiControl corresponde a un producto tecnológico, complementado con una actividad de gestión digital. Se trata de un sistema diseñado para controlar, identificar y monitorear el flujo de pacientes dentro de una institución mediante dispositivos y herramientas digitales integradas.</p>
        </div>
    </section>

    <section class="pagina" id="noticontrol">
        <div class="login-contenedor">
            <?php if(!isset($_SESSION['usuario'])): ?>
                <p class="titulo-seccion">// System.Access_Required</p>
                <h2 class="titulo-seccion-grande">Iniciar Sesión</h2>
                
                <form class="login-caja" method="post">
                    <input type="text" name="usuario" placeholder="USUARIO" required>
                    <input type="text" name="codigo" placeholder="ID INSTITUCIÓN" required>
                    <input type="email" name="correo" placeholder="EMAIL" required>
                    <input type="password" name="contraseña" placeholder="CONTRASEÑA" required>
                    <input type="submit" name="login" value="Autenticar">
                    <?php if($error != "") echo "<p class='bad'>$error</p>"; ?>
                </form>

            <?php else: ?>
                <div style="width: 100%; text-align: center;">
                    <p class="titulo-seccion">// Terminal_Active</p>
                    <h2 class="titulo-seccion-grande">Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
                    <div class="tarjeta" style="margin-top: 30px; text-align: left;">
                        <h3>Información de Pacientes (Base de Datos)</h3>
                        <p>Monitoreo en tiempo real desde ESP32 (192.168.80.20):</p>
                        <hr style="border-color: var(--borde); margin: 20px 0;">
                        
                        <div id="tabla-pacientes">
                            <p>Cargando registros del sistema Nerclose...</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>© 2026 <span>Nerclose</span> — Tecnología para la vida</p>
    </footer>

    <script>
        function mostrar(id) {
            var paginas = document.getElementsByClassName('pagina');
            for (var i = 0; i < paginas.length; i++) {
                paginas[i].classList.remove('activa');
            }
            var seleccionada = document.getElementById(id);
            if (seleccionada) {
                seleccionada.classList.add('activa');
            }
        }

        window.onload = function() {
            <?php if(isset($_SESSION['usuario'])): ?>
                mostrar('noticontrol');
            <?php endif; ?>
        };
    </script>
</body>
</html>