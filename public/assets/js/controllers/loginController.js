import { getCookie, setCookie } from "./../components/cookies.js";

export const isCheked = () => {
    const checkbox = document.getElementById("recordar"); 
    const email = document.getElementById("email"); 
    checkbox.checked ? setCookie("recuerdame", email.value) : '';  
}

export function comprobarCookieRecuerdame() {

    const input_email = document.getElementById("email"); 
    input_email.value = getCookie("recuerdame") ?? ''; 

}