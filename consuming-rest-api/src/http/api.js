import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/api/v1",
  withCredentials: true,
  headers: {
    "Accept": "application/json",
  }
});

function getCookie(name) {
  const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
  if (match) return decodeURIComponent(match[2]);
  return null;
}

api.interceptors.request.use(config => {
  const token = getCookie('XSRF-TOKEN');
  if (token) {
    config.headers['X-XSRF-TOKEN'] = token;
  }
  return config;
});

export default api;
