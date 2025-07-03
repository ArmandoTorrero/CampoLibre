
/**
 * Renderizar calendario
 * @param {*} calendar 
 */
export function calendar(calendar) {
    flatpickr(calendar, {
        defaultDate: new Date(), 
        dateFormat: "y-m-d",
        locale: "es", 
        minDate: "today", 
        altInput: true, 
        altFormat: "j F, Y",
    });
}