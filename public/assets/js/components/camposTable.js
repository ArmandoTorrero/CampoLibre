import { tabla } from "./../controllers/adminController.js";
import { crearOption } from "./../components/createOption.js";
import { getCampos } from "./../services/campo.js";
import { getModalidades } from "./../services/modalidad.js";
import { crearBoton } from "./button.js";
import { fetchDataJSON } from "./fetchData.js";
import { initForm } from "./initForm.js";
import { crearInput } from "./input.js";
import { validarForm } from "./validarForm.js";

export async function camposTable() {
  const titulo = document.querySelector(".titulo");
  titulo.textContent = "Campos";

  const content = document.querySelector(".content .table");

  const table = tabla("campos");
  content.appendChild(table);

  const campos_obj = Object.values(await getCampos()).map((item) => ({
    id: item.id,
    nombre: item.nombre,
    tipo:
      item.modalidad_id == 1
        ? "Fútbol"
        : item.modalidad_id == 2
        ? "Tenis"
        : "Pádel",
    estado: item.disponible == 1 ? "Disponible" : "No disponible",
    precio: `${item.precio_hora}€/hora`,
  }));

  $("#campos").DataTable({
    destroy: true,
    data: campos_obj,
    responsive: true,
    columns: [
      { title: "Nombre", data: "nombre" },
      { title: "Tipo", data: "tipo" },
      { title: "Estado", data: "estado" },
      { title: "Precio", data: "precio" },
      {
        title: "Acciones",
        data: null,
        render: function (data, type, row) {
          return containerAcciones(row.id).outerHTML;
        },
      },
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json", // Español
    },
  });

  // Evento para eliminar un campo
  document.getElementById("campos").addEventListener("submit", (ev) => {
    if (ev.target.matches(".delete-campo")) {
      ev.preventDefault();
      Swal.fire({
        title: "¿Estas seguro?",
        text: "No podras revertirlo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar campo",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          initForm(ev.target, "/deleteCampo");
          ev.target.closest("tr").remove();
        }
      });
    }
  });

  abrirCerrarDialog();

  // Evento para manejar el envío del formulario de edición
  document.addEventListener("submit", (ev) => {
    if (ev.target.matches(".form-edit-campo")) {
      ev.preventDefault();
      initForm(ev.target, "/editCampo");
      const dialog = document.querySelector(".dialog-campo");
      if (dialog) dialog.close(); // Cierra el dialog después de enviar el formulario
    }
  });
}

// contenedor el cual contiene los botones de editar y eliminar
function containerAcciones(id) {
  const acciones_container = document.createElement("article");
  acciones_container.classList.add("acciones_container");

  acciones_container.appendChild(editCampo(id));
  acciones_container.appendChild(deleteCampo(id));

  return acciones_container;
}

// boton de editar
function editCampo(id) {
  const button = crearBoton("Editar", "btn", "submit");
  button.classList.add("btn-primary");
  button.classList.add("editar-btn");
  button.value = id;

  return button;
}

//boton de eliminar
function deleteCampo(id) {
  const button = crearBoton("Eliminar", "btn", "submit");
  button.classList.add("btn-danger");

  const input_hidden = crearInput("id_campo", "hidden", id);

  const form = document.createElement("form");
  form.classList.add("delete-campo");
  form.method = "POST";
  form.appendChild(button);
  form.appendChild(input_hidden);

  return form;
}

// funcion que permite abrir y cerrar el dialog de edición
function abrirCerrarDialog() {
  // Delegación para abrir el dialog de edición
  document.getElementById("campos").addEventListener("click", async (ev) => {
    if (ev.target.matches(".editar-btn")) {
      ev.preventDefault();
      const dialog = document.querySelector(".dialog-campo");
      if (dialog) dialog.showModal();

      const form = dialog.querySelector("form");
      const input_hidden = form.querySelector("#id_campo");
      input_hidden.value = ev.target.value;

      const { info_campo } = await fetchDataJSON("/getCampoById", {
        id_campo: ev.target.value,
      });
      addInfoForm(info_campo, form);
    }
  });

  // Delegación para cerrar el dialog con el botón cancelar
  document.addEventListener("click", (ev) => {
    if (ev.target.matches(".dialog-campo .cancelar-btn")) {
      const dialog = ev.target.closest(".dialog-campo");
      if (dialog) dialog.close();
    }
  });
}

// funcion para añadir la informacion del campo al formulario de edición
async function addInfoForm({ nombre, modalidad_id, disponible }, form) {
  const input_nombre = form.querySelector("#nombre_campo");
  const select_modalidad = form.querySelector("#modalidad");
  const select_disponible = form.querySelector("#disponibilidad");

  const { modalidades } = await getModalidades();

  modalidades.map((modalidad) => {
    const option = crearOption(modalidad.nombre, modalidad.id);
    select_modalidad.appendChild(option);
  });

  validarForm(
    [input_nombre],
    [form.querySelector("#nombre_campo + span")],
    [/^[a-zA-ZÁÉÍÓÚáéíóúñÑ0-9\s]{3,100}$/], // permite tildes, ñ y espacios
    form.querySelector(".enviar")
  );

  input_nombre.value = nombre;
  select_modalidad.value = modalidad_id;
  select_disponible.value = disponible;

  // Aquí podrías agregar más lógica para manejar el formulario si es necesario
}
