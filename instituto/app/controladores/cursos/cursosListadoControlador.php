<?php

$sql_usuarios = "SELECT * FROM cursos as cur
inner join alumnos as alu on cur.alumnoId = alu.idAlumno ";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$cursos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
