import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/api/v1", // 👈 đúng cổng Laravel Sail
  withCredentials: true, // 👈 bắt buộc để gửi cookie và CSRF token
  headers: {
    "Accept": "application/json",
  }
});

export default api;
