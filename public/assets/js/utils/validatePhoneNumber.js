

export function validatePhoneNumber(phoneNumber) {

    const regex = /^\d{9}$/;

    return regex.test(phoneNumber);
}