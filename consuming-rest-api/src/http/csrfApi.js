import axios from "axios";

const csrfApi = axios.create({
  baseURL: "http://localhost", // root Laravel
  withCredentials: true,
  headers: {
    Accept: "application/json",
  },
});


export default csrfApi;




