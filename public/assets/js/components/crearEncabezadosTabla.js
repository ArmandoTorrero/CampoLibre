export function crearEncabezadoTabla(idTabla, columnas) {

    const tabla = document.getElementById(idTabla)
    const thead = document.createElement("thead"); 

    tabla.appendChild(thead); 
    const fila = document.createElement('tr');

    columnas.forEach(col => {
      const th = document.createElement('th');
      th.textContent = col;
      fila.appendChild(th);
    });

    thead.appendChild(fila);
}