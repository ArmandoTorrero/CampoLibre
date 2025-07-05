/**
 * Función para crear un input  
 * @param {*} name 
 * @param {*} type 
 * @returns 
 */
export function crearInput(name, type, input_value = "") {
    let input = document.createElement("input");
    input.type = type;
    input.name = name; 
    input.value = input_value; 

    return input;
}