<?php
session_start(); 
error_reporting(0);
//Si no hemos iniciado sesion, no podemos estar aqui
if (!isset($_SESSION["usuario"])) {
    header("Location: http://localhost/proyecto/index.php");
    die();
}/* __DIR__ dirname  _SERVER*/

//si te pasas 2 min inactivo, se te expulsa de la pagina
$inactivo = 120;
 
if(isset($_SESSION['tiempo']) ) {

    if((time() - $_SESSION['tiempo']) > $inactivo){
        session_destroy();
        header("Location: index.php"); 
    }
}

$_SESSION['tiempo'] = time();