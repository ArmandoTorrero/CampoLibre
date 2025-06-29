export function validateName(name) {
    const regex = /^[a-zA-Z0-9]{3,15}$/; 

    return regex.test(name);
}