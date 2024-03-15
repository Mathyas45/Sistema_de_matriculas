<?php
include('../../config.php');

$alumnoId = $_POST['alumnoId'];

// Verificar si el alumno tiene cursos en el carrito
$sentencia_verificar = $pdo->prepare("SELECT alumnoId, cursoId, aulaId, seccionId FROM carritos WHERE alumnoId = :alumnoId");
$sentencia_verificar->bindParam(':alumnoId', $alumnoId);
$sentencia_verificar->execute();
$registros_carrito = $sentencia_verificar->fetchAll(PDO::FETCH_ASSOC);

// Si se encontraron cursos en el carrito
if ($registros_carrito) {
    // Iniciar transacción
    $pdo->beginTransaction();

    try {
        // Iterar sobre los cursos en el carrito
        foreach ($registros_carrito as $registro) {
            $cursoId = $registro['cursoId'];
            $aulaId = $registro['aulaId'];
            $seccionId = $registro['seccionId'];

            // Verificar si el curso ya está matriculado
            $sentencia_verificar_matricula = $pdo->prepare("SELECT * FROM matriculas WHERE alumnoId = :alumnoId AND cursoId = :cursoId");
            $sentencia_verificar_matricula->bindParam(':alumnoId', $alumnoId);
            $sentencia_verificar_matricula->bindParam(':cursoId', $cursoId);
            $sentencia_verificar_matricula->execute();
            $registro_matricula = $sentencia_verificar_matricula->fetch(PDO::FETCH_ASSOC);

            // Si el curso ya está matriculado, mostrar un mensaje de error
            if ($registro_matricula) {
                session_start();
                $_SESSION['mensaje'] = "El curso con ID $cursoId ya está matriculado por este alumno.";
                $_SESSION['icono'] = "error";
                header('Location:' . APP_URL . '/admin/carrito/index.php');
                exit();
            }

            // Insertar en la tabla de matriculas si el curso no está matriculado previamente
            $sentencia = $pdo->prepare('INSERT INTO matriculas (alumnoId, cursoId, aulaId, seccionId) VALUES (:alumnoId, :cursoId, :aulaId, :seccionId)');
            $sentencia->bindParam(':alumnoId', $alumnoId);
            $sentencia->bindParam(':cursoId', $cursoId);
            $sentencia->bindParam(':aulaId', $aulaId);
            $sentencia->bindParam(':seccionId', $seccionId);
            $sentencia->execute();

            // Incrementar en uno la capacidad del aula
            $sentencia_update_capacidad = $pdo->prepare('UPDATE aulas SET nCapacidad = nCapacidad + 1 WHERE idAula = :aulaId');
            $sentencia_update_capacidad->bindParam(':aulaId', $aulaId);
            $sentencia_update_capacidad->execute();
        }

        // Vaciar el carrito
        $sentencia_vaciar = $pdo->prepare('DELETE FROM carritos WHERE alumnoId = :alumnoId');
        $sentencia_vaciar->bindParam(':alumnoId', $alumnoId);
        $sentencia_vaciar->execute();

        // Confirmar la transacción
        $pdo->commit();

        // Redireccionar con mensaje de éxito
        session_start();
        $_SESSION['mensaje'] = "Se guardó la matrícula correctamente";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . '/admin/index.php');
        exit();
    } catch (PDOException $e) {
        // Revertir transacción en caso de error
        $pdo->rollback();

        // Redireccionar con mensaje de error
        session_start();
        $_SESSION['mensaje'] = "Error al procesar la matrícula: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . '/admin/carrito/index.php');
        exit();
    }
} else {
    // No se encontraron cursos en el carrito
    session_start();
    $_SESSION['mensaje'] = "No hay cursos en el carrito para matricular";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . '/admin/carrito/index.php');
    exit();
}
?>
