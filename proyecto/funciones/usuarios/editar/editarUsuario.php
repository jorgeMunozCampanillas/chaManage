<?php
//Hacemos un control de sesion
require_once("../../../controlSesion.php");
require_once("../../../clases/usuarios.php");
//Sacamos de session el usuario con el que iniciamos sesión y el que vamos a modificar
$yo = unserialize($_SESSION["usuario"]);
$usuarioModificar = $yo->buscarUsuarioID($_GET["usuario"]);
$usuarioModificar = $usuarioModificar[0];

if (isset($_POST["nombre"]) && isset($_POST["tipo"])) {
    //editamos el usuario y mandamos a la página de nuevo
    $yo->editarUsuario($_POST["id_empleado"], $_POST["pass"], $_POST["tipo"], $_POST["nombre"]);
    header("Location: ../buscar/buscadorUsuario.php?busqueda=".$_GET['busqueda']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<header class="row border border-2">    
    <!--  BTN atras  -->
    <form class="col-1" action="../../atras/atras.php">
        <button class="btn"><i class="bi bi-arrow-left-square-fill fs-2"></i></button>
    </form>
    <h1 class="fs-3 fw-bold col-10 d-flex justify-content-center align-items-center">Editar Usuario</h1>
</header>
<body class="w-100">
    <div class="w-100 d-flex flex-column align-items-center mt-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../../../media/usuario2.jpg">
            <form method="POST" class="d-flex d-flex flex-column align-items-center">
                <!-- id -->
                <input type="hidden" name="id_empleado" value=<?= $usuarioModificar->id_empleado ?>>
                <!-- nombre -->
                <div class="card-body form-group">
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" class="form-control" value=<?= $usuarioModificar->nombre ?> required>
                </div>
                <!-- pass -->
                <div class="card-body form-group">
                    <label for="pass">Contraseña:</label>
                    <input name="pass" type="password" class="form-control" value=<?= $usuarioModificar->contrasenia ?> required>
                </div>
                <!-- tipo -->
                <div class="card-body form-group">
                    <label for="nombre">Tipo:</label><br>
                    <input type="radio" id="tipo" name="tipo" value="1" required>
                    <label for="tipo">Encargado</label>
                    <br>
                    <input type="radio" id="tipo" name="tipo" value="2" checked>
                    <label for="tipo">Empleado</label>
                </div>
                <!-- fecha -->                        
                <div class="card-body form-group">
                    <label for="fecha">Fecha entrada:</label>
                    <input value="<?= $usuarioModificar->fecha ?>" name="fecha" type="date" class="form-control" required>
                </div>
                <input type="submit" class="btn btn-primary w-75" value="Modificar">
            </form>
        </div>
    </div>
</body>
</html>