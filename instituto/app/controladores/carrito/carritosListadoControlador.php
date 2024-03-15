<?php

$sql_usuarios = "SELECT * FROM carritos as mat
inner join alumnos as alu on mat.alumnoId = alu.idAlumno 
inner join secciones as sec on mat.seccionId = sec.idSeccion
inner join cursos as cur on mat.CursoId = cur.idCurso 
inner join aulas as au on mat.AulaId = au.idAula
";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$carritos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
