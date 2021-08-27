import {http, httpFile} from './http_service';

export function createRegisterAboutUs(data) {
    return httpFile().post('/aboutus', data)
}