<?php

require "includes/conexion.php";

global $mysqli;

function isNullLogin($usuario, $password)
{
    if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
        return true;
    } else {
        return false;
    }
}

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


function lastSession($id)
{
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE personas SET lastsession=NOW() WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
}


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