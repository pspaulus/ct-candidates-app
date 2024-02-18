import axios from "axios";

class Api {
    constructor(token = null) {
        const headers = this.getHeaders({ token });
        this.http = axios.create({
            baseURL: 'http://127.0.0.1:8000/api/',
            headers,
        });
    }

    getHeaders(params) {
        const headers = {
            Accept: "application/json",
            "content-type": "application/json",
        };

        if (params && params.token) {
            headers["Authorization"] = `Bearer ${params.token}`;
        }

        return headers;
    }
}

export { Api };
