    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterAcademicOffer(data) {
    return httpFile().post('/academicOffers', data)
}
    // Function to use send request API load registers.
export function loadRegisterAcademicOffer() {
    return http().get('/academicOffers')
}
    // Function to use send request API delete registers selected.
export function deleteAcademicOfferRegister(id) {
    return http().delete(`academicOffers/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterAcademicOffer(id, data) {
    return httpFile().post(`/academicOffers/${id}`, data)
}
