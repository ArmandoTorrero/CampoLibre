/**
 * Función para crear label
 * @param {*} texoLabel 
 * @returns 
 */
export function crearLabel(texoLabel) {
    let label = document.createElement("label"); 
    label.textContent = texoLabel;

    return label;
}