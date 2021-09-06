    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterServiceHome(data) {
    return httpFile().post('/servicesHomes', data)
}
    // Function to use send request API load registers.
export function loadRegisterServiceHome() {
    return http().get('/servicesHomes')
}
    // Function to use send request API delete registers selected.
export function deleteServiceHomeRegister(id) {
    return http().delete(`servicesHomes/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterServiceHome(id, data) {
    return httpFile().post(`/servicesHomes/${id}`, data)
}
