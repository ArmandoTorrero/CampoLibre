import { BASE_URL } from "./config/config.js"
import { changeNav } from "./controllers/mainController.js"
import { logueado } from "./services/user.js"

document.addEventListener("DOMContentLoaded", () => {

    logueado().then(info => {
        changeNav(info.rol)

        
    })

})