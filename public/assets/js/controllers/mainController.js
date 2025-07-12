import { BASE_URL } from "./../config/config";

export const changeNav = (rol) => {
    
    if (rol == false) return;  

    const enlace = document.querySelector(".navbar-nav").children[2].children[0]; 
        
    enlace.textContent = "Perfil"; 
    enlace.href = `${BASE_URL}/perfil`; 
    
} 

