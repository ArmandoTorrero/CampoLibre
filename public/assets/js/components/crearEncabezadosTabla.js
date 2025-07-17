import { capitalizar } from "./datatable";

export function crearEncabezadoTabla(idTabla, keys) {
  const thead = document.querySelector(`#${idTabla} thead`);
  thead.innerHTML = '';
  const fila = document.createElement('tr');
  keys.forEach(k => {
    const th = document.createElement('th');
    th.textContent = capitalizar(k);
    fila.appendChild(th);
  });
  thead.appendChild(fila);
}
