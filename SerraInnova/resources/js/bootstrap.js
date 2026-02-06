import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Configuración base de la URL API
window.axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

// Restaurar token si existe
// Restaurar token si existe
const token = localStorage.getItem('token');
if (token) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

// Interceptor para manejar errores 401 (No autenticado)
window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 401) {
            // Limpiar sesión local
            localStorage.removeItem('token');
            localStorage.removeItem('user');

            // Redirigir a welcome si no estamos ya allí
            if (window.location.pathname !== '/welcome' && window.location.pathname !== '/login') {
                window.location.href = '/welcome';
            }
        }
        return Promise.reject(error);
    }
);
