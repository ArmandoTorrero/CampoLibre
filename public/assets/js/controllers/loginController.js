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

export const mostrarPasswd = () => {
    
    const input_mostrar = document.getElementById("mostrar"); 
    
    const input_passwd = document.getElementById("passwd"); 
    

    input_mostrar.addEventListener("change", (ev) => {
         
        input_passwd.type = ev.target.checked ? 'text' : 'password'; 
    })

}