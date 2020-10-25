<?php
require_once "conexion.php";
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

$metodo = $_SERVER['REQUEST_METHOD'];


$solicitud = ($_GET['id']);

switch ($metodo) {
    case 'GET':
        if ($solicitud == "lista") {
            $todo = $mysqli->query(" SELECT * FROM productos");
            $rowtodo = $todo->fetch_all(MYSQLI_ASSOC);
        } else {
            $idproducto = $_GET["id"];
            $todo = $mysqli->query(" SELECT * FROM productos WHERE id = $idproducto");
            $rowtodo = $todo->fetch_all(MYSQLI_ASSOC);
        }

        if ($rowtodo == []) {
            exit(json_encode(array("status" => 'NO se encontraron datos ')));
            break;
        }

        exit(json_encode($rowtodo));
        break;

    case 'POST':
        if (isset($_POST['ccodigo'])) {
            $codigo = $_POST['ccodigo'];
            $nombre = $_POST['cnombre'];
            $precio = $_POST['cprecio'];
            $insertProduct = $mysqli->prepare("INSERT INTO productos(codigo, nombre, precio) VALUES(?, ?, ?)");
            $insertProduct->bind_param('isi', $codigo, $nombre, $precio);
            $insertProduct->execute();
            exit(json_encode(array("status" => 'Insercion exitosa ')));
        } else {
            exit(json_encode(array("status" => 'Algo pasa ')));
            break;
        }
        break;

    case 'PUT':
        if (isset($_GET['ecodigo'])) {
            $eid = $_GET['eid'];
            $enombre = $_GET['enombre'];
            $eprecio = $_GET['eprecio'];
            $edescripcion = $_GET['edescripcion'];

            $editarProduct  = $mysqli->prepare("UPDATE productos SET nombre='$enombre', precio=$eprecio, edescripcion=$edescripcion, WHERE id = ?");
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
            var_dump($id);
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
