<?php
include('../../app/config.php');
include('../../app/controladores/carrito/carritosDeleteControlador.php');


// Verifica si se proporcionó un ID de usuario válido
if (isset($_GET['idCarrito'])) {
    $idCarrito = $_GET['idCarrito'];
    eliminar($idCarrito); // Implementa esta función en usuariosControlador.php
}

// Redirecciona a la página principal después de eliminar el usuario
header("Location: index.php");
exit();