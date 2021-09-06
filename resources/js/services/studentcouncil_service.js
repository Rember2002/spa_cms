    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterStudentCouncil(data) {
    return httpFile().post('/studentCouncils', data)
}
    // Function to use send request API load registers.
export function loadRegisterStudentCouncil() {
    return http().get('/studentCouncils')
}
    // Function to use send request API delete registers selected.
export function deleteStudentCouncilRegister(id) {
    return http().delete(`studentCouncils/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterStudentCouncil(id, data) {
    return httpFile().post(`/studentCouncils/${id}`, data)
}
