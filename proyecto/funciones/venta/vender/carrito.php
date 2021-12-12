<?php
require_once("../../../controlSesion.php");
require_once("../../../clases/item.php");
require_once("../../../clases/venta.php");
require_once("../../../clases/usuarios.php");

//Buscamos el item y obtenemos su id
$item = Item::buscarItemId($_GET["item"]);
$idItem = $item->getId();

//Si no tenemos carrito, es pq realizamos una venta y no vendimos más, o pq
//cerramos sesion y teniamos un carrito creado, entonces tendremos que ver si tenemos que 
//recuperarlo o crear uno nuevo
if (!isset($_SESSION["carrito"])) {
    
    //Sacamos de sesion al usuario
    $usuario = unserialize($_SESSION["usuario"]);
    
    //Creamos una nueva venta sin fecha y sin precio
    $venta = new Venta($usuario->getId());
    $venta->aniadirVenta();
    
    //Metemos en la sesion el carrito del usuario
    $_SESSION["carrito"]=$venta->getId();
}else {
    //Recuperamos la instancia de la venta pasandole su id
    $venta = Venta::recuperarInstanciaVenta($_SESSION["carrito"]);
}

//Dependiendo de si se ha añadido al carrito ese item ya o no, se modificara o se añadira
if ($venta->existeVentaItem($item, $_SESSION["carrito"])) {
    //Modificamos la cantidad que hemos comprado
    $venta->modificarCantidad($item, $_GET["unidades"]);
} else {
    //Pasamos a itroducir el item en la ventaItem
    $venta->aniadirVentaItem($item, $_GET["unidades"]);
}

header("Location: vender.php?busqueda=".$_GET['busqueda']);