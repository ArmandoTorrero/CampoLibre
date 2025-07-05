
/**
 * Crear boton
 * @param {*} clase 
 * @returns 
 */
export function crearBoton(texto,clase = 'btn', type = "button") {
    let boton = document.createElement("button"); 
    boton.type = type; 
    boton.textContent = texto; 
    boton.classList.add(clase); 

    return boton; 
}