<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/item.php");

//Recuperamos el item y lo borramos
$item = Item::buscarItemId($_GET["id_borrar"]);
$item->borrarItem();

header("Location: ../buscar/buscador.php?item=".$_GET['busqueda']);