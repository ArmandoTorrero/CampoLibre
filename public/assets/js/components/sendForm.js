import { BASE_URL } from "./../config/config.js";

export async function sendForm(form, ruta) {

    const formData = new FormData(form);
        try {
            const response = await fetch(`${BASE_URL}${ruta}`, {
                method: "POST",
                body: formData,
            });
            return await response.json();
           
        } catch (error) {
            console.error("Error:", error);
        }
}
