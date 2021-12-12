<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/venta.php");
require_once("../../../clases/usuarios.php");
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
<header class="row border border-2">    

    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>

    <div class="col-10 d-flex justify-content-center align-items-center">
        <span class="fs-3 fw-bold me-2">Buscar: </span>
        <form method="GET" class="w-50">
            <input placeholder="Id venta..." class="w-75" id="input" name="busqueda" type="text" value=<?= $_GET['busqueda']??"" ?>>
            <input id="buscar" type="submit" value="Buscar">
        </form>
    </div>
</header>
<body>

    <!-- datos -->
    <div class="d-flex flex-column align-items-center mt-5">
        <div class="container d-flex flex-wrap">
            <!-- Datos -->
            <?php 
                        
                //Si hemos pasado algo por el buscador, lo buscara
                if (isset($_GET["busqueda"])) {
                    $resultado = Item::buscarItem("%".$_GET["busqueda"]."%");
                    listar($resultado);
                }
                //Si aun no hemos pasado nada, muestra todos los resultados
                else{
                    $resultado = Venta::consultarVentaEmpleado($usuario->getId());
                    listar($resultado);
                }
                function listar($datos){
                    foreach($datos as $dato){ ?>
                        <div class="card w-25 m-3" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <?php
                                        if ($dato->fecha=="0000-00-00") {?>
                                            <p>????-??-??</p>
                                            <a href="../vender/vender.php" class="w-50 btn btn-outline-danger mb-1">Incompleta</a>
                                        <?php }else { ?>
                                            <p><?= $dato->fecha ?></p>

                                            <form method="POST" action="visualizacion.php">
                                                <input type="hidden" value="<?= $dato->id_venta ?>" name="idVenta">
                                                <input type="submit" value="ver" class="btn btn-outline-success mb-1">
                                            </form>
                                            
                                        <?php } ?>
                                </h5>
                                <div class="card-text d-flex justify-content-between">
                                    <p>Id venta: <?= $dato->id_venta ?></p>
                                    <p>Valor: <?= $dato->valor=="0" ? "?" : $dato->valor ?>€</p>
                                </div>
                                <p>Contirbución:</p>
                                <div class="card-text progress">
                                    <div class="progress-bar " role="progressbar" style="width: <?= $dato->valor*100/Venta::totalGanado()[0]->total ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
<script src="buscador.js"></script>
</html>