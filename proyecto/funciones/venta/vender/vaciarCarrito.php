<?php
require_once("../../../controlSesion.php");
require_once("../../../clases/venta.php");

//Si tenemos el carrito seteado
if (isset($_SESSION["carrito"])) {
    //Recuperamos la instancia de la venta pasandole su id
    $venta = Venta::recuperarInstanciaVenta($_SESSION["carrito"]);
    //Eliminamos las venta item y la venta
    $venta->eliminarTodaVentaItem();
    $venta->eliminarVenta();

    //eliminamos la variable de sesion carrito
    unset($_SESSION["carrito"]);
}

header("Location: vender.php");