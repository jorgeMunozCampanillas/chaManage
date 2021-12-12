<?php
//Hacemos un control de sesion
    require_once("../../../controlSesion.php");
    require_once("../../../clases/usuarios.php");
    require_once("../../../clases/venta.php");
    require_once("../../../clases/item.php");

    //Recuperamos la instancia de la venta pasandole su id
    $venta = Venta::recuperarInstanciaVenta($_POST["idVenta"]);

    //Recuperamos la info general venta
    $ventaTotal = $venta->obtenerVenta();
    $ventaTotal = $ventaTotal[0];
    
    //Recuperamos los items de la venta
    $ventaItem = $venta->consultarVentaItem($_POST["idVenta"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<!-- Menu navegacion -->
<header class="row border border-2 w-100 py-3">    
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>

    <div class="col-10 d-flex justify-content-center align-items-center">
        <h1 class="fs-3 fw-bold me-2">Albaran #<?= $_POST["idVenta"] ?> </h1>
    </div>
</header>

<body>
    <!-- Resultados -->
    <div class="container shadow border border-2 mt-4">
        <!-- Cabecera -->
        <div class="d-flex justify-content-between align-items-center">
            <img src="../../../media/logo2.png" alt="">
            <h1>ChaManager</h1>
            <div>
                <h2>Pedido: #<?= $_POST["idVenta"] ?></h2>
                <h4><?= $ventaTotal->fecha ?></h4>
                <h5>Atendido por: #<?= $ventaTotal->id_empleado ?></h5>
            </div>
        </div>

        <!-- Cuerpo -->
        <table class="table table-striped mt-4">
            <!-- Cabeceras -->
            <thead>
                <tr>
                    <th scope="col">Id Item</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($ventaItem as $totalVentaItem){

                //Por cada item lo tenemos que buscar   
                $item = Item::buscarItemId($totalVentaItem->id_item);
                ?>
                    <tr>
                        <!-- id Item -->
                        <th scope="col">#<?= $totalVentaItem->id_item ?></th>
                        <!-- nombre -->
                        <th scope="col"><?= $item->nombre ?></th>
                        <!-- Cantidad -->
                        <th scope="col"><?= $totalVentaItem->cantidad ?></th>
                        <!-- Precio -->
                        <th scope="col"><?= $item->precio ?></th>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="border">
                        TOTAL: <?= $venta->obtenerValor()[0]->total ?>€</tr>
                    </th>
            </tfoot>
        </table>
    </div>
</body>
</html>