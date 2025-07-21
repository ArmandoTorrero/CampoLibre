import { fetchData } from "./../components/fetchData.js";


export function getAllReservasByUser() {
    return fetchData('/getAllReservasByUser')
}

export function getAll() {
    return fetchData('/getAll'); 
}