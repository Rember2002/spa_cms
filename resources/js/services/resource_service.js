    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterResource(data) {
    return httpFile().post('/resources', data)
}
    // Function to use send request API load registers.
export function loadRegisterResource() {
    return http().get('/resources')
}
    // Function to use send request API delete registers selected.
export function deleteResourceRegister(id) {
    return http().delete(`resources/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterResource(id, data) {
    return httpFile().post(`/resources/${id}`, data)
}
