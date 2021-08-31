    // Import Store to use centralized warehouse to components.
import store from '../store';
    // Import Axios to use management the send and response API request.
import axios from 'axios';
    // Function to use declare baseURL API in requests axios.
export function http() {
    return axios.create({
            // Important check the baseURL in server.
        baseURL: 'http://127.0.0.1:8000/api'
    });
};
    // Function to use declare baseURL and headers in requests axios.
export function httpFile() {
    return axios.create({
        baseURL: store.state.apiURL,
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
}