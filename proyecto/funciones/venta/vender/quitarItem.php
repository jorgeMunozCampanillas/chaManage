<?php
require_once("../../../controlSesion.php");
require_once("../../../clases/venta.php");

//Recuperamos la instancia de la venta pasandole su id
$venta = Venta::recuperarInstanciaVenta($_SESSION["carrito"]);

//Le pasamos el id del item que queremos eliminar
$venta->eliminarVentaItem($_GET["eliminar"]);

header("Location: vender.php?busqueda=".$_GET['busqueda']);