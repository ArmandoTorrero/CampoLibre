import { fetchData } from "../components/fetchData.js";


export function getAll() {
    return fetchData('/getAllReservas')
}