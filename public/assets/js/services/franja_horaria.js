import { BASE_URL } from "./../config/config";


export async function getHorarioByFecha(fecha) {
    try {
        const response = await fetch(`${BASE_URL}/getHorariosByFecha`, {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json'
            }, 
            body:JSON.stringify({ fecha: fecha }) 
        }); 

        return await response.json();
                
    } catch (error) {
        console.log(error);
            
    }
}