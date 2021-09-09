    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterGrade(data) {
    return httpFile().post('/grades', data)
}
    // Function to use send request API load registers.
export function loadRegisterGrade() {
    return http().get('/grades')
}
    // Function to use send request API delete registers selected.
export function deleteGradeRegister(id) {
    return http().delete(`grades/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterGrade(id, data) {
    return httpFile().post(`/grades/${id}`, data)
}
