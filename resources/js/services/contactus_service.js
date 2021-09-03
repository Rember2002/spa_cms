    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterContactUs(data) {
    return httpFile().post('/contactUs', data)
}
    // Function to use send request API load registers.
export function loadRegisterContactUs() {
    return http().get('/contactUs')
}
    // Function to use send request API delete registers selected.
export function deleteContactUsRegister(id) {
    return http().delete(`contactUs/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterContactUs(id, data) {
    return httpFile().post(`/contactUs/${id}`, data)
}
