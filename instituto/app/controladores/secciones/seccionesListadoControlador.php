<?php

$sql_usuarios = "SELECT * FROM secciones as sec 
inner join cursos as cur on sec.cursoId = cur.idCurso 
inner join aulas as au on sec.AulaId = au.idAula

where sec.cursoId = '$cursoId' and  au.nCapacidad < 2
";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$secciones = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
