import { BASE_URL } from "./../config/config";
import { sendForm } from "./sendForm";

export function initForm(form, ruta) {
    
    sendForm(form, ruta).then((result) => {
                
        Swal.fire({
            title: result.mensaje,
            icon: result.exito ? "success" : "error"
        });

        if (result.redirect) {
            setTimeout(() => {
                window.location.href = `${BASE_URL}${result.redirect}`
            }, 1000);
        }
        
    }).catch((err) => {
        console.log(err);
        
    });
}