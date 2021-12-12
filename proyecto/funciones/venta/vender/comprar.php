<?php
require_once("../../../controlSesion.php");
require_once("../../../clases/item.php");
require_once("../../../clases/venta.php");

$idVenta = $_SESSION["carrito"];

//Recuperamos la instancia de la venta pasandole su id
$venta = Venta::recuperarInstanciaVenta($_SESSION["carrito"]);

//Nos traemos el carrito
$carrito = $venta->consultarVentaItem();

//Actualizamos el stock de los items, quitandole la cantidad que hayamos comprado
foreach ($carrito as $item) {
    $venta->actualizarStock($item->id_item);
}

//Validamos la venta
$venta->validarVenta();

//Eliminamos la variable carrito de sesion
unset($_SESSION["carrito"]);

header("Location: vaciarCarrito.php?busqueda=".$_GET["busqueda"]);



/*
SELECT I.stock - VI.cantidad as resto FROM 
`ventaitem` VI JOIN `item` I 
ON VI.id_item = I.id_item;

UPDATE item SET item.stock = (SELECT I.stock-VI.cantidad FROM 
`item` I JOIN `ventaitem` VI
ON VI.id_item = I.id_item);
*/