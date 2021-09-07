    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterCommission(data) {
    return httpFile().post('/commisions', data)
}
    // Function to use send request API load registers.
export function loadRegisterCommission() {
    return http().get('/commisions')
}
    // Function to use send request API delete registers selected.
export function deleteCommissionRegister(id) {
    return http().delete(`commisions/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterCommission(id, data) {
    return httpFile().post(`/commisions/${id}`, data)
}

    // Function to use send request API load registers.
export function loadRegisterStudentCouncil() {
    return http().get('/studentCouncils')
}
