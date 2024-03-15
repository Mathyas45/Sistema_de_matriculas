<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'intituto');

define('APP_NAME', 'SISTEMA DE MATRICULAS');
define('APP_URL', 'http://localhost/instituto/instituto/');
define('KEY_API_MAPS', '');



$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;
try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "conexion exitosa con la BD";
} catch (PDOException $e) {
    echo  "error no se pudo establecer conexion con la bd";
}

date_default_timezone_set("America/Lima");
$fechayhora = date("Y-m-d H:i:s");
$horaActual = date('H:i:s');

$fechaActual = date('Y-m-d');
$diaActual = date('d');
$mesActual = date('m');
$anioActual = date('Y');
$diaActual = date('d');

// echo 'el dia de hoy es '.$diaActual,' siendo el mes '.$mesActual.'del anio'.$anioActual. ' a la hora de '. $horaActual;

$estadoRegistro = '1';


