import { BASE_URL } from "./../config/config";
import { crearForm } from "./../components/form";
import { crearBoton } from "./../components/button";

export const changeNav = (rol) => {
    
    if (rol == false) return;  

    const navBar = document.querySelector(".navbar-nav"); 
    const enlace = document.querySelector(".navbar-nav").children[2].children[0]; 
        
    enlace.textContent = "Perfil"; 
    enlace.href = `${BASE_URL}/perfil`; 

    
} 

