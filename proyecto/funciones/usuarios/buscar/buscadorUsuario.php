<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/usuarios.php");
//Sacamos de sesion el usuario con el que hicimos sesion
$usuario = unserialize($_SESSION["usuario"]);
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
<!-- Menu navegacion -->
<header class="row border border-2 w-100">    
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>
    <nav class="col-10 d-flex justify-content-center align-items-center">
        <span class="fs-3 fw-bold me-2">Buscar: </span>
        <form method="GET" class="w-50">
            <input class="w-75" id="input" name="busqueda" type="text" value=<?php print_r($_GET['usuario']??""); ?>>
            <input id="buscar" type="submit" value="Buscar">
        </form>
    </nav>
</header>
<body>

    <!-- Tabla datos -->
    <div class="d-flex flex-column align-items-center mt-5">
    <div class="container">
        <table class="table table-striped">
            <!-- Cabeceras -->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
        <!-- Datos -->
        <?php 
                    
            //Si hemos pasado algo por el buscador, lo buscara
            if (isset($_GET["busqueda"])) {
                $resultado = $usuario->buscarUsuarioNombre("%".$_GET["busqueda"]."%");
                listar($resultado);
            }
            //Si aun no hemos pasado nada, muestra todos los resultados
            else{
                $resultado = $usuario->buscarUsuarioNombre("%");
                listar($resultado);
            }

            function listar($datos){
                foreach($datos as $usuario){ 
                    ?>
                    <tr>
                        <th scope="col"><?= $usuario->id_empleado ?></th>
                        <th scope="col"><?= $usuario->nombre ?></th>
                        <th scope="col"><?= $usuario->tipo == 1 ? "Encargado" : "Empleado" ?></th>
                        <th scope="col">
                            <!-- boton borrar -->
                            <a href="../borrar/borrar.php?busqueda=<?= $_GET["usuario"] ?? '' ?>&&id_borrar=<?= $usuario->id_empleado ?>">
                                <i class="bi bi-trash-fill text-danger"></i></a> |
                            <!-- boton editar -->
                            <a id="editar" href="../editar/editarUsuario.php?busqueda=<?= $_GET["busqueda"] ?? '' ?>&&usuario=<?= $usuario->id_empleado ?>" class="text-dark">
                                <i class="bi bi-nut-fill text-warning"></i></a>
                        </th>

                    </tr>
            <?php } } ?>
            </tbody>
        </table>

    </div>
    </div>
</body>
<script src="buscador.js"></script>
</html>