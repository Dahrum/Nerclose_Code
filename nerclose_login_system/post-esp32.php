<?php
include("con_db.php");

if(isset($_POST['uid_tag'])) {
    $uid = mysqli_real_escape_string($conex, $_POST['uid_tag']);
    
    // Guardamos el movimiento en el historial
    $sql = "INSERT INTO historial_accesos (uid_tag) VALUES ('$uid')";
    
    if(mysqli_query($conex, $sql)) {
        echo "CÓDIGO RECIBIDO: " . $uid;
    } else {
        echo "ERROR BD";
    }
}
?>