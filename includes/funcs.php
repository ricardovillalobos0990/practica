<?php
// COnexion a base de datos
require "includes/conexion.php";

global $mysqli;

// FUncion para validar que los campos de Login no este vacios
function isNullLogin($usuario, $password)
{
    if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
        return true;
    } else {
        return false;
    }
}

// Validar login de usuario sea con correo o id, se valida que el usuario este activo y se re dirige a pagina de productos
function login($usuario, $password)
{
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT idpersona, id, persis_idpersis, password FROM personas WHERE id = ? || email = ? LIMIT 1");
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    if ($rows > 0) {

        if (isActivo($usuario)) {
            $stmt->bind_result($idpersona, $id, $persis_idpersis, $passwd);
            $stmt->fetch();
            $validaPassw = password_verify($password, $passwd);
            if ($validaPassw) {

                lastSession($id);

                $_SESSION['idpersona'] = $idpersona;
                $_SESSION['id'] = $id;
                $_SESSION['idpersis'] = $persis_idpersis;

                header("location: form.php");
            } else {
                $errors = "La contrase&ntilde;a es incorrecta";
            }
        } else {
            $errors = 'El usuario no esta activo';
        }
    } else {
        $errors = "El nombre de usuario o correo electr&oacute;nico no existe";
    }
    return $errors;
}
//Funcion para validar que el usuario este activo
function isActivo($usuario)
{
    // El usuario siempre estara activo
    $activacion = 1;

    if ($activacion == 1) {
        return true;
    } else {
        return false;
    }
}
//Funcion para registrat ultimo inicio de sesion en la palicacion
function lastSession($id)
{
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE personas SET lastsession=NOW() WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
}
// Funcion para validar los errores presentandos durante el login
function resultBlock($errors)
{
    if (count($errors) > 0) {
        echo "<div id='error' class='alert alert-warning alert-dismissible fade show' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button>
			<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}
