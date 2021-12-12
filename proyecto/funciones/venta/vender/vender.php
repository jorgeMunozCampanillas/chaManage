<?php
require_once("../../../controlSesion.php");
require_once("../../../clases/item.php");
require_once("../../../clases/venta.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<!-- Menu navegacion -->
<header class="row border border-2 w-100">  
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>  
    <div class="d-flex justify-content-center align-items-center col-10">
        <span class="fs-3 fw-bold me-2">Buscar: </span>
        <form method="GET" class="w-50">
            <input class="w-75" id="input" name="busqueda" type="text" value=<?= $_GET['busqueda']??"" ?>>
            <input id="buscar" type="submit" value="Buscar">
        </form>
    </div>
</header>
<body>

    <!-- Contenido -->
    <div class="row mt-5 ms-5 me-5">
        <!-- Tabla datos -->
        <div class="col-9 d-flex flex-column align-items-center">
                <table class="border table table-striped">
                    <!-- Cabeceras -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Carrito</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Datos -->
                        <?php 
                    
                    //Si hemos pasado algo por el buscador, lo buscara
                    if (isset($_GET["busqueda"])) {
                        $resultado = Item::buscarItem("%".$_GET["busqueda"]."%");
                        listar($resultado);
                    }
                    //Si aun no hemos pasado nada, muestra todos los resultados
                    else{
                        $resultado = Item::buscarItem("%");
                        listar($resultado);
                    }
                    
                    function listar($datos){
                        foreach($datos as $item){ ?>
                    <tr>
                        <!-- id -->
                        <th scope="col"><?= $item->getId() ?></th>
                        <!-- nombre -->
                        <th scope="col"><?= $item->nombre ?></th>
                        <!-- descripcion -->
                        <th scope="col">
                            <?php echo strlen($item->descripcion)>65 ? substr($item->descripcion,0,65)."..." :  $item->descripcion; ?>
                        </th>
                        <!-- precio -->
                        <th scope="col"><?= $item->precio ?></th>
                        <!-- stock -->
                        <th scope="col"><?= $item->stock ?></th>
                        
                        <th scope="col">
                            <form action="carrito.php">
                                <!-- boton carrito -->
                                <button type="submit">
                                    <i class="bi bi-cart3"></i>
                                </button>
                                <input type="hidden" name="busqueda" value=<?= $_GET['busqueda']??"" ?>>
                                <input type="hidden" name="item" value=<?php echo $item->getId(); ?>>
                                <input required min=1 max="<?= $item->stock ?>" class="w-25" id="unidades" name="unidades" type="number">
                                <label for="unidades"> unds.</label>
                            </form>
                        </th>
                        
                    </tr>
                    <?php
                }
            }
            ?>
                    </tbody>
                </table>
    </div>
    <!-- Zona carrito -->
    <div class="col-3 shadow rounded overflow-auto" style="height: 40rem">
        <h2 class="text-center"><b>Carrito</b></h2>
        <?php
        //Si hemos añadido algo al carrito, tendremos la variable sesion[carrito]
            if (isset($_SESSION["carrito"]) && $_SESSION["carrito"]!=null) { 
                ?>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbdy>
                <?php
                //Recuperamos la instancia de la venta pasandole su id
                $venta = Venta::recuperarInstanciaVenta($_SESSION["carrito"]);
                //Por cada elemento del carrito que hayamos añadido, vamos a ir mostrandolo
                $carrito = $venta->consultarVentaItem();
                foreach($carrito as $ventaItem){
                    //Sacamos el item
                    $item = Item::buscarItemId($ventaItem->id_item);
                    ?>
                    <tr>
                        <th scope="row"><?= $item->getId() ?></th>
                        <td><?= $item->nombre ?> X <?= $ventaItem->cantidad ?></td>
                        <td>
                            <a class="text-danger" href="quitarItem.php?busqueda=<?= $_GET['busqueda']??"" ?>&&eliminar=<?= $item->getId() ?>">
                                <i class="bi bi-x-square-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbdy>
                <h1>Total: <?= $venta->obtenerValor()[0]->total ?? 0 ?></h1>
                <br>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-outline-danger text-dark" href="vaciarCarrito.php"><b>Vaciar carrito <i class="bi bi-x-square-fill"></i></b></a>
                    <a class="btn btn-outline-warning text-dark" href="comprar.php?"<?= $_GET['busqueda']??"" ?>>
                        <b>Comprar<i class="bi bi-currency-euro"></i></b>
                    </a>
                </div>
                <?php } 
            else {  ?>
            <div class="text-center mt-5">
                <img class="w-50 opacity-25" src="../../media/carrito.png" alt="">
                <p class="mt-5"><b>Esto esta un poco desierto :(</b></p>
            </div>
                <?php } ?>
            </div>
</div>
</body>
</html>