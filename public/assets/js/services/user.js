import { fetchData } from "./../components/fetchData.js";
import { BASE_URL } from "./../config/config.js";


/**
 * Obtener lista de usuarios
 * @returns 
 */
export async function getUsuarios() {
    return fetchData('/usuarios'); 
}

/**
 *
 * Obtener el rol del usuario
 * @return {*} 
 */
export async function logueado () {
    try {
        const response = await fetch(`${BASE_URL}/logueado`); 
        return await response.json(); 
        
    } catch (error) {
        console.error(error);
        
    }
}

export function getUserInfo() {
    return fetchData('/getUserInfo'); 
}