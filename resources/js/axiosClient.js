import axios from 'axios'

const instance = axios.create();

axios.interceptors.request.use(function (config) {
  // todo
  return config;
});

export default instance