<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/usuarios.php");
$usuario = unserialize($_SESSION["usuario"]);
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
    <link rel="stylesheet" href="aniadirUsuario.css">
</head>
<?php
    //Si nombre, pass y tipo estan seteadas, introducimos al user en la bd
    if (isset($_POST["nombre"]) && isset($_POST["pass"]) && isset($_POST["tipo"])) {
        //Hacemos una comprobación de que no nos han metido otro tipo
        if ($_POST["tipo"]==1 || $_POST["tipo"]==2) {
            //Introducimos el usuario
            $usuario->aniadirUsuario(md5($_POST["pass"]), $_POST["nombre"], $_POST["tipo"], $_POST["fecha"]);
        }
        $_POST = [];
    }
?>


<header class="row border d-flex justify-content-center align-items-center">
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>
    <h1 class="text-center col-10">Añadir nuevo usuario</h1>
</header>

<body class="border">
    <div class="w-100 m-auto d-flex flex-column align-items-center my-5">
        <div class="row m-auto shadow" >
            <img class="col w-25" src="../../../media/usuario2.jpg">
            <form method="POST" class="fs-4 text-center m-auto col">
                <!-- nombre -->
                <div class=" form-group">
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" class="form-control" required>
                </div>
                <!-- pass -->
                <div class=" mt-4 form-group">
                    <label for="pass">Contraseña:</label>
                    <input name="pass" type="password" class="form-control" required>
                </div>
                <!-- tipo -->
                <div class=" mt-4 d-flex align-items-center">
                    <div class="text-start card-body form-group">
                        <label for="nombre">Tipo:</label><br>
                        <input type="radio" id="tipo" name="tipo" value="1" required>
                        <label for="tipo">Encargado</label>
                        <br>
                        <input type="radio" id="tipo" name="tipo" value="2" checked>
                        <label for="tipo">Empleado</label>
                    </div>    
                </div>
                <!-- fecha -->                    
                <div class=" mt-4 form-group">
                    <label for="fecha">Fecha entrada:</label>
                    <input name="fecha" value="<?= date("Y-m-d") ?>" type="date" class="form-control" required>
                </div>
                <input type="submit" class="btn btn-primary w-75 mt-3" value="Crear">
            </form>
        </div>
    </div>
</body>
</html>