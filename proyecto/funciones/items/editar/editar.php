<?php 
    require_once("../../../clases/item.php");
    //Hacemos un control de sesion
    require_once("../../../controlSesion.php");

    //Recuperamos el item
    $item = Item::buscarItemId($_GET["item"]);    
    
    //Si esta seteado id_item, quiere decir que hemos dado click en cambiar
    if (isset($_GET["modificar"])) {
        $item->editarItem($_GET["nombre"], $_GET["descripcion"], $_GET["precio"], $_GET["stock"]);
        header("Location: ../buscar/buscador.php?busqueda=".$_GET["busqueda"]);
    }
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
<body>

    <div class="row border text-center align-items-center">
        <!--  BTN atras  -->
        <form class="col-1" action="../../atras/atras.php">
            <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
        </form>
        <h1 class="col-10">Editar item</h1>
    </div>

    <div class="mt-5 p-3 d-flex justify-content-center align-items-center">
        <form class="w-50 shadow border mb-5 bg-white rounded p-3 fs-4">
            <!-- busqueda -->
            <input type="hidden" name="busqueda" value=<?= $_GET["busqueda"] ?>>
            <!-- id_item -->
            <input type="hidden" name="item" value=<?= $_GET["item"] ?>>
            <!-- señalamos que hemos dado en buscar -->
            <input type="hidden" name="modificar" value="true" ?>
            

            <!-- nombre -->
            <div class="form-group my-2">
                <label for="nombre">Nombre:</label>
                <input name="nombre" type="text" value="<?= $item->nombre ?>" class="form-control" id="nombre">
            </div>
            <!-- descripcion -->
            <div class="form-group my-2">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3"><?= $item->descripcion ?> </textarea>
            </div>

            <div class="row my-2">
                <!-- precio -->
                <div class="col form-group ">
                    <label for="precio">Precio</label>
                    <input name="precio" type="number" value=<?= $item->precio ?> class="form-control" id="precio" placeholder="...€">
                </div>
                <!-- stock -->
                <div class="col form-group">
                    <label for="stock">Stock</label>
                    <input name="stock" type="number" value=<?= $item->stock ?> class="form-control" id="stock" placeholder="stock">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success m-3" type="submit">Cambiar</button>
                <button class="btn btn-danger m-3" type="submit">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>