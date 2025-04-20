export default class Ajax {
    constructor(baseURL = '') {
        this.baseURL = baseURL;
    }

    async request(endpoint, method = 'GET', data = null, headers = {}) {
        const config = {
            method,
            headers: {
                'Content-Type': 'application/json',
                ...headers
            }
        };
        if (data) {
            config.body = JSON.stringify(data);
        }
        return await fetch(this.baseURL + endpoint, config);
    }

    get(endpoint, headers = {}) {
        return this.request(endpoint, 'GET', null, headers);
    }

    post(endpoint, data, headers = {}) {
        return this.request(endpoint, 'POST', data, headers);
    }

    put(endpoint, data, headers = {}) {
        return this.request(endpoint, 'PUT', data, headers);
    }

    delete(endpoint, headers = {}) {
        return this.request(endpoint, 'DELETE', null, headers);
    }
}