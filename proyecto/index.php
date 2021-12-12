<?php //Contraseñas creadas -> 1234
//Iniciamos sesion, para tener nuestras variables de session 
session_start(); 


//Si hemos iniciado sesión, no se puede estar en esta página
if (isset($_SESSION["usuario"])) {
    header("Location: home.php");
    die();
}

require_once("clases/usuarios.php");
require_once("clases/venta.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body class="d-flex flex-column justify-content-center align-items-center">
    <!--Máquina de estados-->
    <div id="todo" class="d-flex flex-column justify-content-center align-items-center w-25 border border-primary border-5 rounded py-5 shadow-lg p-3 bg-body rounded">
        <img class="w-25 pt-3" id="icon" src="media/logo2.PNG" alt="">
        <h1 class="fw-bold text-info">ChaManager</h1>
        <form class="d-flex flex-column justify-content-center align-items-center pt-5 pb-3" method="POST">

        <?php 
            //Si estan seteadas las 2, quiere decir que el user habra dado click en el boton de enviar
            if (isset($_POST["user"]) && isset($_POST["pass"])) {

                //Verificamos sus credenciales
                if ($usuario = Usuario::login($_POST["user"], md5($_POST["pass"]))) {
                    //Lo serializamos y cambiamos de página
                    $_SESSION["usuario"]=serialize($usuario);
                    
                    //Miramos si tenia un carrito y si es asi, lo recuperamos
                    if ($carrito = Venta::recuperarCarrito($usuario->getId())) {
                        $_SESSION["carrito"]=$carrito[0]->id_venta;
                    }

                    header("Location: home.php");
                }

            //si hemos llegado aqui, quiere decir que no hemos encontrado al usuario o sus credenciales no son correctas :(
    ?>

            <input class="w-100 text-center fs-3 m-3 border border-danger border-3 rounded error" placeholder="Usuario" type="text" name="user" required>
            <input class="w-100 text-center fs-3 m-3 border border-danger border-3 rounded error" placeholder="Contraseña" type="password" name="pass" required>
            <input class="btn btn-primary fs-3 w-50 mt-3 shadow-sm" type="submit" value="Entrar">
        </form>
    </div>       
    <div class="alert alert-warning w-25 text-center mt-2 shadow-lg" role="alert"><b>¡Usuario o contraseña incorrectas!</b></div>
    <?php
            }else{
            //si entramos por aqui, aun no hemos intentado inciar sesion
    ?>
    
            <input class="w-100 text-center fs-3 m-3" placeholder="Usuario" type="text" name="user" required>
            <input class="w-100 text-center fs-3 m-3" placeholder="Contraseña" type="password" name="pass" required>
            <input class="btn btn-primary fs-3 w-50 mt-3 shadow-sm" type="submit" value="Entrar">
        </form>
    </div>       
            

    <?php } ?>
 
</body>
</html>