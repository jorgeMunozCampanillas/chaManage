<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");

require_once("../../../clases/item.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Menu navegacion -->
    <nav class="row border border-2 w-100">    

        <!--  BTN atras  -->
        <form class="col-1" action="../../atras/atras.php">
            <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
        </form>

        <div class="col-10 d-flex justify-content-center align-items-center">
            <span class="fs-3 fw-bold me-2">Buscar: </span>
            <form method="GET" class="w-50">
                <input class="w-75" id="input" name="busqueda" type="text" value=<?= $_GET['busqueda']??"" ?>>
                <input id="buscar" type="submit" value="Buscar">
            </form>
        </div>
    </nav>

    <!-- Tabla datos -->
    <div class="d-flex flex-column align-items-center mt-5">
    <div class="container">
        <table class="table table-striped">
            <!-- Cabeceras -->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Acción</th>
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
                foreach($datos as $item){?>
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
                            <!-- boton borrar -->
                            <a href="../borrar/borrar.php?busqueda=<?= $_GET['busqueda'] ?? '' ?>&&id_borrar=<?= $item->getId() ?>">
                                <i class="bi bi-trash-fill text-danger"></i></a> |
                            <!-- boton editar -->
                            <a id="editar" class="text-dark" href="../editar/editar.php?busqueda=<?php 
                                echo $_GET['busqueda'] ?? '';
                                echo "&&item=".$item->getId();
                            ?>">
                                <i class="bi bi-nut-fill text-warning"></i></a>
                        </th>

                    </tr>
                    <?php
                }
            }
        ?>
            </tbody>
        </table>

    </div>
    </div>
</body>
<script src="buscador.js"></script>
</html>