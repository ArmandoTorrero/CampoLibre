import { fetchData } from "../components/fetchData.js";


export function getAllReservas() {
    return fetchData('/getAllReservas')
}