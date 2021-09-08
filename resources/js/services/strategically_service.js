    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterStrategicAlly(data) {
    return httpFile().post('/strategicAllies', data)
}
    // Function to use send request API load registers.
export function loadRegisterStrategicAlly() {
    return http().get('/strategicAllies')
}
    // Function to use send request API delete registers selected.
export function deleteStrategicAllyRegister(id) {
    return http().delete(`strategicAllies/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterStrategicAlly(id, data) {
    return httpFile().post(`/strategicAllies/${id}`, data)
}
