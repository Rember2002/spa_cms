    // Import http service to use config routes API. 
import {http, httpFile} from './http_service';

    // Function to use send request API create register.
export function createRegisterCarousel(data) {
    return httpFile().post('/carousels', data)
}
    // Function to use send request API load registers.
export function loadRegisterCarousel() {
    return http().get('/carousels')
}
    // Function to use send request API delete registers selected.
export function deleteCarouselRegister(id) {
    return http().delete(`carousels/${id}`)
}
    // Function to use send request API update register selected.
export function updateRegisterCarousel(id, data) {
    return httpFile().post(`/carousels/${id}`, data)
}
