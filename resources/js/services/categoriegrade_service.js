    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterCategorieGrade(data) {
    return httpFile().post('/categorieGrade', data)
}
    // Function to use send request API load registers.
export function loadRegisterCategorieGrade(id) {
    return http().get(`/categorieGrade/${id}`)
}
    // Function to use send request API delete registers selected.
export function deleteCategorieGradeRegister(id) {
    return http().delete(`categorieGrade/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterCategorieGrade(id, data) {
    return httpFile().post(`/categorieGrade/${id}`, data)
}
