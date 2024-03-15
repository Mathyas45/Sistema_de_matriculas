<?php
include('../app/config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM alumnos WHERE email = '$email' ";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
// print_r($usuarios);


$contador = 0;
foreach($usuarios as $usuario){
    $contador++;//cuando tengamos un usuario que coincida con la bd el email se aumenta el contador 
    $password_tabla = $usuario['password']; // traemos el password del usuario que ya validamos su correo 
}


if (($contador>0) && (password_verify($password, $password_tabla))) { 

    echo "Bienvenido";
    session_start();
    $_SESSION['mensaje'] = "Bienvenido al sistema";
    $_SESSION['icono'] = "success";

    //ahora validaremos el correo del email que se verifico como usuario

    $_SESSION['sesion_email'] = $email;
    

    header('Location:' .APP_URL."/admin");
}else{
    //mandamos el mensaje de error al login vista
    session_start();
    $_SESSION['mensaje'] = "Los datos son incorrectos, vuelva a intentarlo";
    header('Location:'.APP_URL.'/login');
}