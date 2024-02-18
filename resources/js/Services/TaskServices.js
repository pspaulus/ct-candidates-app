import { Api } from '../Api/Api';

const authToken = localStorage.getItem('token');
const api = new Api(authToken);

export const createTask = async (newTask) => {
    try {
        const response = await api.http.post('tasks', {
            title: newTask,
            fulfilled: false,
        });
        return response.data
    } catch (error) {
        // Handle error
    }
};

export const getTasks = async () => {
    try {
        const response = await api.http.get('tasks');
        return response.data;
    } catch (error) {
        // Handle error
    }
};

export const completeTask = async (id) => {
    try {
        const response = await api.http.put(`tasks/${id}/complete`);
        return response.data;
    } catch (error) {
        // Handle error
    }
};

export const deleteTask = async (id) => {
    try {
        const response = await api.http.delete(`tasks/${id}`);
        return response.data;
    } catch (error) {
        // Handle error
    }
};
