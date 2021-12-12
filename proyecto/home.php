<?php 
//controlamos que haya iniciado sesion
require_once ("controlSesion.php");
require_once("clases/conexion.php");
require_once("clases/usuarios.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php 
    //Comprobar que tipo de usuario es, y en funcion de ello, mostrar x cosas
    $conexion = Conexion::crearConexion("mysql:host=localhost;dbname=polvero", "root", "");
    $usuario = unserialize($_SESSION["usuario"]);
    ?>
    <div class="container mt-5">
        <div class="row my-3">
            <a class="text-center align-middle btn btn-danger w-25" href="cerrarSesion.php">Cerrar sesion</a>
        </div>
        <div class="row"> 
            <!-- ALMACEN -->
            <div class="col-4 border-end">
                <h1 class="text-center mt-2">GESTION ALMACEN</h1>
                <div class="mt-4 d-flex">
                    <div class="card shadow p-3 m-2">
                        <div id="almacen__gestionar" class="icono card-img-top"></div>
                        <a class="btn btn-primary"href="funciones/items/buscar/buscador.php">Gestionar</a>
                    </div>
                    <div class="card shadow p-3 m-2">
                        <div id="almacen__aniadir" class="icono card-img-top"></div>
                        <a class="btn btn-primary"href="funciones/items/aniadir/aniadir.php">Añadir</a>
                    </div>
                </div>
            </div>
    
            <?php if ($usuario->getTipo()==1) { ?>
            <!-- USUARIOS -->
            <div class="col-4 border-end">
                <h1 class="text-center mt-2">GESTION USUARIOS</h1>
                <div class="mt-4 d-flex">
                    <div class="card shadow p-3 m-2">
                        <div id="usuario__gestionar" class="icono card-img-top"></div>
                        <a class="btn btn-primary w-100"href="funciones/usuarios/buscar/buscadorUsuario.php">Gestionar</a>
                    </div>
                    <div class="card shadow p-3 m-2">
                        <div id="usuario__aniadir" class="icono card-img-top"></div>
                        <a class="btn btn-primary w-100"href="funciones/usuarios/aniadir/aniadirUsuario.php">Añadir</a>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- ALMACEN -->
            <div class="col-4">
                <h1 class="text-center mt-2">VENTAS</h1>
                <div class="mt-4 d-flex">
                    <div class="card shadow p-3 m-2">
                        <div id="ventas__vender" class="icono card-img-top"></div>
                        <a class="btn btn-primary w-100"href="funciones/venta/vender/vender.php">Vender</a>
                    </div>
                    <div class="card shadow p-3 m-2">
                        <div id="ventas__albaranes" class="icono card-img-top"></div>
                        <a class="btn btn-primary w-100"href="funciones/venta/albaranes/albaran.php">Albaranes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>