import { setCookie } from "./../components/cookies";


export function aceptarTerminos() {
    const checkbox = document.getElementById("terminos-condiciones"); 
    setCookie("terminosCondiciones", checkbox.checked);    
}

