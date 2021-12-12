<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/usuarios.php");
$usuario = unserialize($_SESSION["usuario"]);
//Borramos el usuario y volvemos a la página de busqueda
$usuario->borrarUsuario($_GET["id_borrar"]);
header("Location: ../buscar/buscadorUsuario.php?usuario=".$_GET['busqueda']);