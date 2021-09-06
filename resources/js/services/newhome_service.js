    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterNewHome(data) {
    return httpFile().post('/newHomes', data)
}
    // Function to use send request API load registers.
export function loadRegisterNewHome() {
    return http().get('/newHomes')
}
    // Function to use send request API delete registers selected.
export function deletNewHomenRegister(id) {
    return http().delete(`newHomes/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterNewHome(id, data) {
    return httpFile().post(`/newHomes/${id}`, data)
}
