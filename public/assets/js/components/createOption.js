/**
 * Crear option para un select
 * @param {*} textContent 
 * @param {*} value 
 * @returns 
 */
export function crearOption(textContent,value) {
    let option = document.createElement("option"); 
    option.textContent = textContent; 
    option.value = value; 

    return option; 
}