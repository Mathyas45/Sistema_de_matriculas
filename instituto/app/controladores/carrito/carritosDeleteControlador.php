<?php

function eliminar($idCarrito)
{

    // Ejemplo:
    global $pdo; // Asegúrate de tener la conexión a la base de datos disponible
    $query = "DELETE FROM carritos WHERE idCarrito = :idCarrito ";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':idCarrito', $idCarrito, PDO::PARAM_INT);
    $statement->execute();
}
