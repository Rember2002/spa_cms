    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterAboutUs(data) {
    return httpFile().post('/aboutus', data)
}
    // Function to use send request API load registers.
export function loadRegisterAboutUs() {
    return http().get('/aboutus')
}
    // Function to use send request API delete registers selected.
export function deleteAboutUsRegister(id) {
    return http().delete(`aboutus/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterAboutUs(id, data) {
    return httpFile().post(`/aboutus/${id}`, data)
}
