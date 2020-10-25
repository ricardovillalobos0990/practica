// INDEX MOSTRAR LISTA DE PROSCUTOS
const CONTENIDO = document.getElementById("clientlist");

const CREAR = document.getElementById("crear");
CREAR.addEventListener("click", crearProducto);

const EDITAR = document.getElementById("editar");
EDITAR.addEventListener("click", editarProductos);

// const ELIMINAR = document.getElementById("eliminar");
// ELIMINAR.addEventListener("click", eliminarProductos);

//EJECUTA LISTAR PRODUCTOS AL CARGAR LA PAGINA
window.addEventListener("load", (event) => {
  event.preventDefault();
  listarProductos();
});

//FUNCION LISTA PRODUCTOS
async function listarProductos() {
  const url = "http://localhost/practica/includes/lista";
  let response = await fetch(url);
  let datosLista = await response.json();
  mostrarTablaProductos(datosLista);
}

//CREACION DE LA TABLA PRODUCTOS CON LA RESPUESTA JSON
function mostrarTablaProductos(datos) {
  CONTENIDO.innerHTML = "";
  for (let valor of datos) {
    CONTENIDO.innerHTML += `
      <tr>
        <th id="valortable">${valor.id}</th>
          <td>${valor.nombre}</td>
          <td>${valor.precio}</td>
          <td>${valor.descripcion}</td>
          <td>
            <button class="btn" id="editar-form" type="button" value='${valor.id}' data-toggle="modal" data-target="#editarModal">
              Editar
            </button>
          </td>
          <td>
            <button class="btn" id="eliminar-form" type="button"value='${valor.id}' data-toggle="modal" data-target="#eliminarModal">
              Eliminar
            </button>
          </td>
      </tr>
    `;
  }
}

// SE INICIALIZAN VARIABLES PARA ENVIAR DATOS Y MOSTRAR ALERTAS
const formulario = document.getElementById("formulario");
const respuesta = document.getElementById("respuesta");
const erespuesta = document.getElementById("erespuesta");
const drespuesta = document.getElementById("drespuesta");

//FUNCION PARA ENVIAR DATOS
function crearProducto() {
  const data = new FormData(formulario);
  fetch("http://localhost/practica/includes/peticiones.php", {
    method: "POST",
    body: data,
  })
    //CONDICIONALES PARA LA RESPUESTA
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error en la llamada Ajax";
      }
    })
    // CONDICONALES PARA EL USO DE LA RESPUESTA
    .then(function (texto) {
      listarProductos();
      formulario.reset();
      respuesta.innerHTML = `
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
        Producto Agregado Correctamente
      </div>
      `;
      // console.log(texto);
      //CERRAR LA ALERTA DEL FORMULARIO CREAR A LOS 5 SEGUNDOS
      window.setTimeout(function () {
        $(".alert").remove();
      }, 5000);
    })
    .catch(function (err) {
      respuesta.innerHTML = `
      <div class="alert alert-warning" role="alert">
        ${err};
      </div>
      `;
      // console.log(err);
    });
}

// SELECCIONAR NODO HIJO A TRAVES DEL PADRE PARA EDITAR
document.querySelector("table").addEventListener("click", (e) => {
  e.preventDefault();
  if (e.target.nodeName == "BUTTON") {
    // console.log(e.target.nodeName);
    valor = e.target.value;
    // console.log(valor);
    traerProductos(valor);
  }
});

//SOLICITUD FETCH PARA EDITAR LA CUAL PASA LOS VALORES A UNA FUNCION MOSTRAR
async function traerProductos(valor) {
  const url = `http://localhost/practica/includes/${valor}`;
  response = await fetch(url);
  let datos = await response.json();
  mostrarProductos(datos);
}

//RECIBE LOS DATOS Y LOS ASIGNA COMO VALOR AL FORMULARIO EN MODAL
function mostrarProductos(datos) {
  const eid = document.getElementById("eid");
  const enombre = document.getElementById("enombre");
  const eprecio = document.getElementById("eprecio");
  const edescripcion = document.getElementById("edescripcion");


  for (let datosProduct of datos) {
    console.log(datos)
    eid.value = datosProduct.id;
    enombre.value = datosProduct.nombre;
    eprecio.value = datosProduct.precio;
    edescripcion.value = datosProduct.descripcion;
  }

  const did = document.getElementById("did");
  const dnombre = document.getElementById("dnombre");
  const dprecio = document.getElementById("dprecio");
  const ddescripcion = document.getElementById("ddescripcion");


  for (let datosEliminar of datos) {
    did.value = datosEliminar.id;
    dnombre.value = datosEliminar.nombre;
    dprecio.value = datosEliminar.precio;
    ddescripcion.value = datosEliminar.descripcion;
  }
}

//AL DAR CLICK SE EJECUTA LA FUNCION EL LA CUAL ENVIA LOS DATOS PARA EDITAR
function editarProductos() {
  const formularioEditar = document.getElementById("formulario-editar");
  const data = new FormData(formularioEditar);
  eid = data.get("eid");
  enombre = data.get("enombre");
  eprecio = data.get("eprecio");
  ecodigo = data.get("edescripcion");


  fetch(`http://localhost/php/drogueria/api/peticiones.php?eid=${eid}&enombre=${enombre}&eprecio=${eprecio}&edescripcion=${edescripcion}`, {
    method: "PUT",
    headers: {
      "Content-type": "application/json",
    },
  })
    //CONDICIONALES PARA LA RESPUESTA
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error en la llamada Ajax";
      }
    })
    // CONDICONALES PARA EL USO DE LA RESPUESTA
    .then(function (texto) {
      listarProductos();
      formularioEditar.reset();
      erespuesta.innerHTML = `
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
        Producto Editado Correctamente
      </div>
    `;
      // console.log(texto);
      //CERRAR LA ALERTA DEL FORMULARIO CREAR A LOS 5 SEGUNDOS
      window.setTimeout(function () {
        $("#editarModal").modal("hide");
        $(".alert").remove();
      }, 1000);
    })
    .catch(function (err) {
      respuesta.innerHTML = `
      <div class="alert alert-warning" role="alert">
        ${err};
      </div>
    `;
      // console.log(err);
    });
}

// AL DAR CLICK SE EJECUTA LA FUNCION EL LA CUAL ENVIA LOS DATOS PARA ELIMINAR
function eliminarProductos() {
  const formularioEliminar = document.getElementById("formulario-eliminar");
  const data = new FormData(formularioEliminar);
  did = data.get("did");

  fetch(`http://localhost/php/drogueria/api/peticiones.php?did=${did}`, {
    method: "DELETE",
    headers: {
      "Content-type": "application/json",
    },
  })
    //CONDICIONALES PARA LA RESPUESTA
    .then(function (response) {
      if (response.ok) {
        return response.text();
      } else {
        throw "Error en la llamada Ajax";
      }
    })
    // CONDICONALES PARA EL USO DE LA RESPUESTA
    .then(function (texto) {
      listarProductos();
      formularioEliminar.reset();
      // console.log(texto);
      //CERRAR LA ALERTA DEL FORMULARIO CREAR A LOS 5 SEGUNDOS
      window.setTimeout(function () {
        $("#eliminarModal").modal("hide");
      }, 500);
    })
    .catch(function (err) {
      respuesta.innerHTML = `
      <div class="alert alert-warning" role="alert">
        ${err};
      </div>
    `;
      // console.log(err);
    });
}
