    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterSalesianExperienceHome(data) {
    return httpFile().post('/salesianExperienceHomes', data)
}
    // Function to use send request API load registers.
export function loadRegisterSalesianExperienceHome() {
    return http().get('/salesianExperienceHomes')
}
    // Function to use send request API delete registers selected.
export function deleteSalesianExperienceHomeRegister(id) {
    return http().delete(`salesianExperienceHomes/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterSalesianExperienceHome(id, data) {
    return httpFile().post(`/salesianExperienceHomes/${id}`, data)
}
