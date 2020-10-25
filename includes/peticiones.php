<?php
// COnexion a la base de datos
require_once "conexion.php";
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

$metodo = $_SERVER['REQUEST_METHOD'];

$solicitud = ($_GET['id']);

switch ($metodo) {
    case 'GET':
        // Listar todos los productos
        if ($solicitud == "lista") {
            $todo = $mysqli->query(" SELECT * FROM productos");
            $rowtodo = $todo->fetch_all(MYSQLI_ASSOC);
        } else {
            //Listar un producto
            $idproducto = $_GET["id"];
            $todo = $mysqli->query(" SELECT * FROM productos WHERE id = $idproducto");
            $rowtodo = $todo->fetch_all(MYSQLI_ASSOC);
        }
        // Conmsulta vacia
        if ($rowtodo == []) {
            exit(json_encode(array("status" => 'NO se encontraron datos ')));
            break;
        }

        exit(json_encode($rowtodo));
        break;

    case 'POST':
        if (isset($_POST['cnombre'])) {
            $nombre = $_POST['cnombre'];
            $precio = $_POST['cprecio'];
            $descripcion = $_POST['cdescripcion'];
            //Creacion de productos en la base de datos con los parametros enviados en el form
            $insertProduct = $mysqli->prepare("INSERT INTO productos(nombre, precio, descripcion) VALUES(?, ?, ?)");
            $insertProduct->bind_param('sis', $nombre, $precio, $descripcion);
            $insertProduct->execute();
            exit(json_encode(array("status" => 'Insercion exitosa ')));
        } else {
            exit(json_encode(array("status" => 'Algo pasa ')));
            break;
        }
        break;

    case 'PUT':
        if (isset($_GET['eid'])) {
            $eid = $_GET['eid'];
            $enombre = $_GET['enombre'];
            $eprecio = $_GET['eprecio'];
            $edescripcion = $_GET['edescripcion'];
            //Editar productos en la base de datos con los parametros enviados en el form
            $editarProduct  = $mysqli->prepare("UPDATE productos SET nombre='$enombre', precio=$eprecio, descripcion='$edescripcion' WHERE id = ?");
            $editarProduct->bind_param('i', $eid);
            $editarProduct->execute();
            exit(json_encode(array("status" => 'Actualizacion exitosa ')));
        } else {
            exit(json_encode(array("status" => 'Algo pasa en la actualizacion')));
            break;
        }
        break;

    case 'DELETE':

        if (isset($_GET['did'])) {
            $id = $_GET['did'];
            //Eliminar producto con el usuario 
            $eliminarProduct  = $mysqli->prepare("DELETE FROM productos WHERE id = ?");
            $eliminarProduct->bind_param('i', $id);
            $eliminarProduct->execute();
            exit(json_encode(array("status" => 'Eliminado Correctamente ')));
        } else {
            exit(json_encode(array("status" => 'Algo pasa en la Eliminacion')));
            break;
        }
        break;
}
