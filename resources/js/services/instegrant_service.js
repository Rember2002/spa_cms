    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterIntegrant(data) {
    return httpFile().post('/integrants', data)
}
    // Function to use send request API load registers.
export function loadRegisterIntegrant() {
    return http().get('/integrants')
}
    // Function to use send request API delete registers selected.
export function deleteIntegrantRegister(id) {
    return http().delete(`integrants/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterIntegrant(id, data) {
    return httpFile().post(`/integrants/${id}`, data)
}
