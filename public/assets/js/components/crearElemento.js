/**
 * Funcion que crea una etiqueta HTML con una clase CSS.
 * @param {*} nombreEtiqueta 
 * @param {*} nombreClase 
 * @returns 
 */
export function crearElemento(nombreEtiqueta,nombreClase) {
    let etiqueta = document.createElement(nombreEtiqueta); 
    etiqueta.classList.add(nombreClase)
    return etiqueta;  
    
}