    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterSalesianExperience(data) {
    return httpFile().post('/salesianExperiences', data)
}
    // Function to use send request API load registers.
export function loadRegisterSalesianExperience() {
    return http().get('/salesianExperiences')
}
    // Function to use send request API delete registers selected.
export function deleteSalesianExperienceRegister(id) {
    return http().delete(`salesianExperiences/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterSalesianExperience(id, data) {
    return httpFile().post(`/salesianExperiences/${id}`, data)
}
