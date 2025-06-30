import { BASE_URL } from "./../config/config.js";


/**
 * Obtener lista de usuarios
 * @returns 
 */
export async function getModalidades() {
    try {
        const response = await fetch(`${BASE_URL}/getModalidades`);
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}