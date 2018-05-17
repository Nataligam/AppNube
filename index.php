<?php

include_once "./app/router/router.php";
//inicia la sesion 
session_start();
//verifica que no se haya excedido el tiempo limite inactividad para la sesion
//si se excedio se destruye la sesion y se redirige al login
if(isset($_SESSION["user_id"])){
    $timeActual=time();
    $diferencia=$timeActual-$_SESSION["ultimoAcceso"];
    $_SESSION["ultimoAcceso"]=$timeActual;
    //si la inactividad es mayor a 30 minutos se destruye la sesion
    if($diferencia>=1800){
        session_destroy();
        header("Location: index.php");
    }
}
$router = new Router();
$router->router();

?>