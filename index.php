<?php
//session_start() crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
session_start();
//require es idéntico a include excepto que en caso de fallo producirá un error fatal de nivel E_COMPILE_ERROR. En otras palabras, éste detiene el script mientras que include sólo emitirá una advertencia (E_WARNING) lo cual permite continuar el script.
require "includes/funcs.php";
//Variable para almacenar los errores
$errors = array();
//empty — Determina si una variable está vacía
if (!empty($_POST)) {
    $id = $mysqli->real_escape_string($_POST["id"]);
    $password = $mysqli->real_escape_string($_POST["password"]);

    //Se envian dos parametros para validar con la funncion isNullLogin que todos los campos contengan registros
    if (isNullLogin($id, $password)) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (count($errors) == 0) {
        $errors[] = login($id, $password);
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- DESCRIPCION DEL SITIO -->
    <meta name="description" content="Login Lexa">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title> Login Lexa </title>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container text-center bg-light">
        <div class="row justify-content-center" style="height: 100vh">
            <div class="col-6 col-md-3 align-self-center">
                <form class="form-signin" id="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <img class="mb-4 img-fluid" src="./images/login/logo-p.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal"> Login Lexa </h1>
                    <label for="inputid" class="sr-only">Usuario</label>
                    <input type="text" id="inputId" class="form-control" placeholder="Usuario" autofocus="" name="id" required="">
                    <label for="inputPassword" class="sr-only">Contraseña</label>
                    <input type="password" id="inputPassword" class="form-control my-3" placeholder="password" required="" name="password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">© 2020</p>
                </form>
                <!-- IMPRESION DE ERRORES -->
                <?php echo resultBlock($errors); ?>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>