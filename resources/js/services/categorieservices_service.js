    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterCategorieService(data) {
    return httpFile().post('/categorieService', data)
}
    // Function to use send request API load registers.
export function loadRegisterCategorieService(id) {
    return http().get(`/categorieService/${id}`)
}
    // Function to use send request API delete registers selected.
export function deleteCategorieServiceRegister(id) {
    return http().delete(`categorieService/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterCategorieService(id, data) {
    return httpFile().post(`/categorieService/${id}`, data)
}
