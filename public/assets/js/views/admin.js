import { BASE_URL } from "./../config/config.js";
import { logueado } from "./../services/user.js";
import { initPerfilAdmin } from "./../controllers/adminController.js"; 


document.addEventListener("DOMContentLoaded", () => {

    logueado().then(info => {
        if (info.rol !== 2) {
            window.location.href = `${BASE_URL}/`
        }
    })

    initPerfilAdmin()
}); 

