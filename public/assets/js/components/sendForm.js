import { BASE_URL } from "../config/config";

export async function sendForm(form, ruta) {

    const formData = new FormData(form);
        try {
            const response = await fetch(`${BASE_URL}${ruta}`, {
                method: "POST",
                body: formData,
            });
            const data = await response.json();
            if (data.exito) {
                return await data.mensaje;
            } else {
                return await data.mensaje;;
            }
        } catch (error) {
            console.error("Error:", error);
        }
}
