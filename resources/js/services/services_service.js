    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterService(data) {
    return httpFile().post('/services', data)
}
    // Function to use send request API load registers.
export function loadRegisterService() {
    return http().get('/services')
}
    // Function to use send request API delete registers selected.
export function deleteServiceRegister(id) {
    return http().delete(`services/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterService(id, data) {
    return httpFile().post(`/services/${id}`, data)
}
