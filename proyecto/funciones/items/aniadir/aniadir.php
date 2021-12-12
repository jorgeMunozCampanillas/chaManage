<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");

require_once("../../../clases/item.php");
require_once("../../../clases/conexion.php");
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
    <?php
        //Si tenemos seteado aniadir, pasamos a introducir los items
        if (isset($_GET["aniadir"])) {
            //Pasamos a ver los valores obtenidos y los introducimos en la bbdd
            foreach ($_GET["aniadir"] as $item) {
                Item::aniadirItem($item["nombre"], $item["descripcion"], $item["precio"], $item["stock"]);
            }
            //Eliminamos los valores una vez introducidos
            unset($_GET["aniadir"]);
        }
    ?>
<header class="row py-3 border">
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>

    <h1 class="text-center col-10">Añadir nuevo item</h1>
</header>

<body class="w-100">
    <div class="container w-75  mt-4">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="col-2">Nombre</th>
                        <th scope="col" class="col-7">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
            </table>
        </div>
        <form id="formulario">
            <div class="row mt-2">
                <input class="col-2" class="w-100" name="aniadir[0][nombre]" class="col-3" type="text" placeholder="Nombre">
                <input class="col-7" class="w-100" name="aniadir[0][descripcion]" class="col" type="text" placeholder="Descripcion">
                <input class="col" class="w-100" name="aniadir[0][precio]" class="col-1" type="text" placeholder="Precio">
                <input class="col" class="w-100" name="aniadir[0][stock]" class="col-1" type="text" placeholder="Stock">
            </div>
        </from>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <input from="formulario" type="submit" class="btn btn-primary" form="formulario" value="Añadir">            
        <i class="bi bi-plus-square btn fs-2" id="aniadir"></i>
    </div>
</body>
<script src="aniadir.js"></script>
</html>