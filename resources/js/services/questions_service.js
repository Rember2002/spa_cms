    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterQuestions(data) {
    return httpFile().post('/questions', data)
}
    // Function to use send request API load registers.
export function loadRegisterQuestions() {
    return http().get('/questions')
}
    // Function to use send request API delete registers selected.
export function deleteQuestiosnRegister(id) {
    return http().delete(`questions/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterQuestions(id, data) {
    return httpFile().post(`/questions/${id}`, data)
}
