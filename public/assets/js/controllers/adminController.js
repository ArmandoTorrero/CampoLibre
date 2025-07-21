import { buttonSelected } from "./../components/buttonSelected.js";
import { cerrarSesion } from "./perfilController.js";
import { ultimasReservas } from "./../components/ultimasReservas.js";
import { reservasTable } from "./../components/reservasTable.js";
import { usuariosTable } from "./../components/usuariosTable.js";
import { camposTable } from "./../components/camposTable.js";

export function tabla(id) {
  const tabla = document.createElement("table");
  const thead = document.createElement("thead");
  const tbody = document.createElement("tbody");

  tabla.id = id;

  tabla.appendChild(thead);
  tabla.appendChild(tbody);

  return tabla;
}

/**
 * Función que contiene toda la lógica de la vista de administrador
 */
export function initPerfilAdmin() {
  const buttons = [...document.querySelectorAll(".buttons button")];
  buttonSelected(buttons, "selected");
  ultimasReservas(); 
  accionarBotones();
  cerrarSesion();
}

function accionarBotones() {
  const buttons = [...document.querySelectorAll(".buttons button")];
  clearTable(buttons[0], () => ultimasReservas());
  clearTable(buttons[1], () => camposTable());
  clearTable(buttons[2], () => reservasTable());
  clearTable(buttons[3], () => usuariosTable());
}

function clearTable(btn, callback) {
    btn.addEventListener("click", () => {
        const tableContainer = document.querySelector(".table");
        
        // 1. Destruye DataTable si existe
        const oldTable = tableContainer.querySelector("table");
        if (oldTable && $.fn.DataTable.isDataTable(oldTable)) {
            $(oldTable).DataTable().destroy(true);
        }

        // 2. Elimina la tabla del DOM
        if (oldTable) {
            oldTable.remove();
        }

        // 3. Ejecuta el callback para crear la nueva tabla
        callback();
    });
}
