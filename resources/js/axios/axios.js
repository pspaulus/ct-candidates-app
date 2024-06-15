import axios from "axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.withCredentials = true;

const csrfToken = document.head.querySelector('meta[name="csrf-token"]');

const token = localStorage.getItem("token");

if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
if (csrfToken) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken.content;
} else {
    console.error("CSRF token not found in meta tags");
}
const XSRF = document.cookie
    .split("; ")
    .find((row) => row.startsWith("XSRF-TOKEN"))
    .split("=")[1];
if (token) {
    axios.defaults.headers.common["XSRF-TOKEN"] = XSRF;
}
export default axios;
