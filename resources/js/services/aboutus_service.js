import {http, httpFile} from './http_service';

export function createRegisterAboutUs(data) {
    return httpFile().post('/aboutus', data)
}

export function loadRegisterAboutUs() {
    return http().get('/aboutus')
}

export function deleteAboutUsRegister(id) {
    return http().delete(`aboutus/${id}`)
}