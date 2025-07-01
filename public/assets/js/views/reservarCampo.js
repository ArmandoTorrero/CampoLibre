import { calendar } from "./../components/calendarComponent";
import { infoCampo } from "./../controllers/reservarCampoController"


document.addEventListener("DOMContentLoaded", () => {

    infoCampo(); 

    const calendario = document.getElementById("fecha"); 

    calendar(calendario); 

})