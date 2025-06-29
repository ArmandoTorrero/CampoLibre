import { BASE_URL } from "./../config/config.js";

/**
 * Funcion que devuelve todos los campos de la BBDD
 * @returns 
 */
export async function getCampos() {
    
    try {
        const response = await fetch(`${BASE_URL}/getCampos`)
        const data = await response.json(); 
        
        return data.campos; 

    } catch (error) {
        console.error(error);
        
    }
}