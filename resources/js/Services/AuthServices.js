import { Api } from '../Api/Api';

const api = new Api();

const setAuthTokenAndUserData = (response) => {
    localStorage.setItem('token', response.data.token);
    localStorage.setItem('userData', JSON.stringify(response.data.user));
    localStorage.setItem('pageReloaded', false);
};

export const login = async (email, password) => {
    try {
        const response = await api.http.post('login', {
            email: email,
            password: password,
        });

        setAuthTokenAndUserData(response);
    } catch (error) {
        // Handle error
    }
};

export const register = async (name, email, password) => {
    try {
        const response = await api.http.post('register', {
            name: name,
            email: email,
            password: password,
        });
        setAuthTokenAndUserData(response);
    } catch (error) {
        // Handle error
    }
};
