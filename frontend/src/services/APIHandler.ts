import axios from 'axios'

const baseDomain = import.meta.env.VITE_FRONTEND_URL;
const baseURL = `${baseDomain}/api/`;
const APIHandler = axios.create({
    baseURL,
    withCredentials: false,
    timeout: 10000
});

APIHandler.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        if (error.response?.status === 401 || error.response?.data?.message === "Invalid or expired token") {
            /**
             * If the user is not authenticated, redirect to the login page
             * Log him out and clear the local storage
             */
        }

        return Promise.reject(error)
    }
)

export default APIHandler;