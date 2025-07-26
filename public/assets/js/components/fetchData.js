import { BASE_URL } from "./../config/config.js";

export async function fetchData(url, opciones = {}) {
  try {
    const response = await fetch(`${BASE_URL}${url}`, opciones);

    if (!response.ok) {
      throw new Error(`Error: ${response.status}: ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error(error);
  }
}

export async function fetchDataJSON(url, data = {}, opciones = {}) {
  try {
    const response = await fetch(`${BASE_URL}${url}`, {
      method: opciones.method || "POST",
      headers: {
        "Content-Type": "application/json",
        ...(opciones.headers || {}),
      },
      body: JSON.stringify(data),
      ...opciones,
    });
    if (!response.ok) {
      throw new Error(`Error: ${response.status}: ${response.statusText}`);
    }
    return await response.json();
  } catch (error) {
    console.error(error);
  }
}
