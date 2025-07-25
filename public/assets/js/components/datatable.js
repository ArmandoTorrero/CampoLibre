import { crearEncabezadoTabla } from "./crearEncabezadosTabla";

export function capitalizar(texto) {
  return texto.charAt(0).toUpperCase() + texto.slice(1);
}


function generarColumnas(keys) {
  return keys.map(k => ({ data: k, title: capitalizar(k) }));
}

export function iniciarTabla(idTabla, datos) {
  const claves = Object.keys(datos[0]);
  crearEncabezadoTabla(idTabla, claves);
  const columnas = generarColumnas(claves);

  $(`#${idTabla}`).DataTable({
    destroy: true,
    data: datos,
    columns: columnas,
    dom: 'lftip',
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json", 
     
    }
  });
}
