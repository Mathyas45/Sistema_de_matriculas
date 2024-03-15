<?php
include('../../config.php');

 $alumnoId = $_POST['alumnoId'];
 $CursoId = $_POST['cursoId'];
 $aulaId = $_POST['aulaId'];
 $seccionId = $_POST['idSeccion'];

// Verificar si el curso ya está en el carrito del alumno
$sentencia_verificar = $pdo->prepare('SELECT * FROM carritos WHERE alumnoId = :alumnoId AND CursoId = :CursoId');
$sentencia_verificar->bindParam(':alumnoId', $alumnoId);
$sentencia_verificar->bindParam(':CursoId', $CursoId);
$sentencia_verificar->execute();
$registro_existente = $sentencia_verificar->fetch(PDO::FETCH_ASSOC);

if ($registro_existente) {
    session_start();
    $_SESSION['mensaje'] = "El curso ya está guardado, no se puede guardar doble vez.";
    $_SESSION['icono'] = "warning";
    header('Location:' . APP_URL . '/admin/index.php');
    exit; // Detener la ejecución del script
} else {
    // Si el curso no está en el carrito del alumno, proceder con la inserción
    $sentencia = $pdo->prepare('INSERT INTO carritos (alumnoId, CursoId, aulaId, seccionId) VALUES (:alumnoId, :CursoId, :aulaId, :seccionId)');
    $sentencia->bindParam(':alumnoId', $alumnoId);
    $sentencia->bindParam(':CursoId', $CursoId);
    $sentencia->bindParam(':aulaId', $aulaId);
    $sentencia->bindParam(':seccionId', $seccionId);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se guardó la materia y horario correctamente";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . '/admin/carrito/index.php');
    } else {
        session_start();
        $_SESSION['mensaje'] = "NO se guardó la materia y horario correctamente";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . '/admin/carrito/index.php');
    }
}
