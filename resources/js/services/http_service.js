import store from '../store';

import axios from 'axios';

export function http() {
    return axios.create({
        baseURL: 'http://127.0.0.1:8000'
    });
};

export function httpFile() {
    return axios.create({
        baseURL: store.state.apiURL,
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
}