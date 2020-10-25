<?php
//session_start() crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
session_start();
//SI EL LOGIN FUE CORRECTO LA SESSION CONTIENE DATOS DE LO CONTRARIO NO TIENE SESSION INICIADA Y SE REDIRCCIONA AL INICIO
if (!isset($_SESSION["id"])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/index.css">
  <title>Practica Lexa</title>
</head>

<body>
  <!-- NAVEGACION -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Practica Lexa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link ml-auto" href="logout.php">Cerrar session </a>
            </div>
        </div>
    </nav>
  <div class="container my-3 bg-light">
    <div class="row justify-content-center text-center">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearModal">
        CREAR PRODUCTO
      </button>
      <!-- MODAL -->
      <form id="formulario" action="" method="POST">
        <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-left">
              <div class="modal-header">
                <h5 class="modal-title" id="titleModal">
                  Agregue el Producto
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--NOMBRE-->
                <div class="mb-3">
                  <label for="cnombre"><span class="badge badge-pill badge-dark">NOMBRE</span> </label>
                  <input type="text" class="form-control" id="cnombre" name="cnombre" placeholder="Nombre" required="" />
                  <div class="invalid-feedback">
                    Se requiere un nombre válido..
                  </div>
                </div>
                <!--NOMBRE-->
                <!--PRECIO-->
                <div>
                  <label for="cprecio"><span class="badge badge-pill badge-dark">PRECIO</span> </label>
                  <input type="number" class="form-control" id="cprecio" name="cprecio" placeholder="Precio" required="" />
                  <div class="invalid-feedback">
                    Se requiere un Precio
                  </div>
                </div>
                <!--PRECIO-->
                <!--DESCRIPCION-->
                <div class="mb-3">
                  <label for="cdescripcion"><span class="badge badge-pill badge-dark">DESCRIPCION</span> </label>
                  <input type="text" class="form-control" id="cdescripcion" name="cdescripcion" placeholder="Descripcion" required="" />
                  <div class="invalid-feedback">
                    Se requiere una Descripcion válida..
                  </div>
                </div>
                <!--DESCRIPCION-->
                <div class="mt-3" id="respuesta">
                  <!-- <div class="alert alert-success" role="alert">
                    A simple success alert—check it out!
                  </div> -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                  Cerrar
                </button>
                <button id="crear" type="button" class="btn btn-success">
                  Guardar Producto
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <table class="table table-responsive-sm table-responsive-md table-responsive-lg table-hover table-primary text-center table-bordered my-2">
      <thead>
        <tr class="bg-primary">
          <th scope="col">ID</th>
          <th scope="col">NOMBRE</th>
          <th scope="col">PRECIO</th>
          <th scope="col">DESCRIPCION</th>
          <th scope="col">IMAGEN</th>
          <th scope="col">EDITAR</th>
          <th scope="col">BORRAR</th>
        </tr>
      </thead>
      <tbody id="clientlist"></tbody>
    </table>
    <!-- EDITAR -->
    <form id="formulario-editar" action="" method="POST">
      <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModal">
                Editar el Producto
              </h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!--NOMBRE-->
              <!-- Se manda campo oculta ya que este contiene identicado unico id "eid editar id en HTML" -->
              <div class="mb-3">
                <input type="hidden" class="form-control" id="eid" name="eid" placeholder="Codigo" />
              </div>
              <div class="mb-3">
                <label for="enombre"><span class="badge badge-pill badge-dark">NOMBRE</span></label>
                <input type="text" class="form-control" id="enombre" name="enombre" placeholder="Nombre" required="" />
                <div class="invalid-feedback">
                  Se requiere un nombre válido..
                </div>
              </div>
              <!--NOMBRE-->
              <!--PRECIO-->
              <div>
                <label for="eprecio"><span class="badge badge-pill badge-dark">PRECIO</span></label>
                <input type="number" class="form-control" id="eprecio" name="eprecio" placeholder="Precio" required="" />
                <div class="invalid-feedback">
                  Se requiere un Precio
                </div>
              </div>
              <!--PRECIO-->
              <!--DESCRIPCION-->
              <div class="mb-3">
                <label for="edescripcion"><span class="badge badge-pill badge-dark">DESCRIPCION</span></label>
                <input type="text" class="form-control" id="edescripcion" name="edescripcion" placeholder="Descripcion" required="" />
                <div class="invalid-feedback">
                  Se requiere una Descricpion válido..
                </div>
              </div>
              <!--DESCRIPCION-->
              <div class="mt-3" id="erespuesta">
                <!-- <div class="alert alert-success" role="alert">
                  A simple success alert—check it out!
                </div> -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                Cerrar
              </button>
              <button id="editar" type="button" class="btn btn-success">
                Guardar Edicción
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- ELIMINAR -->
    <form id="formulario-eliminar" action="" method="GET">
      <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content text-left">
            <div class="modal-header">
              <h5 class="modal-title" id="titleModal">
                Eliminar Producto Seleccionado
              </h5>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Se manda campo oculta ya que este contiene identicado unico id "did eliminar id en HTML" -->
              <div class="mb-3">
                <input type="hidden" class="form-control" id="did" name="did" placeholder="Codigo" />
              </div>
              <!-- NOMBRE -->
              <div class="mb-3">
                <label for="dnombre"><span class="badge badge-pill badge-dark">NOMBRE</span> </label>
                <input type="text" class="form-control" id="dnombre" name="dnombre" placeholder="Nombre" required="" disabled />
                <div class="invalid-feedback">
                  Se requiere un nombre válido..
                </div>
              </div>
              <!-- NOMBRE -->
              <!-- PRECIO -->
              <div>
                <label for="dprecio"><span class="badge badge-pill badge-dark">PRECIO</span> </label>
                <input type="number" class="form-control" id="dprecio" name="dprecio" placeholder="Precio" required="" disabled />
                <div class="invalid-feedback">
                  Se requiere un Precio
                </div>
              </div>
              <!-- PRECIO -->
              <!-- DESCRIPCION -->
              <div class="mb-3">
                <label for="ddescripcion"><span class="badge badge-pill badge-dark">DESCRIPCION</span> </label>
                <input type="text" class="form-control" id="ddescripcion" name="ddescripcion" placeholder="DESCRIPCION" required="" disabled />
                <div class="invalid-feedback">
                  Se requiere una descripcion válida...
                </div>
              </div>
              <!-- DESCRIPCION -->
              <div class="mt-3" id="drespuesta">
                <div class="alert alert-danger" role="alert">
                  ¿Esta seguro que desea borrar el Producto?
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">
                Cerrar
              </button>
              <button id="eliminar" type="button" class="btn btn-danger">
                Eliminar
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
</body>

</html>