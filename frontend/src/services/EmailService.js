import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
  withCredentials: false,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
});

export default {
  getEmails(params) {
    return apiClient.get('/emails', { params });
  },
  getEmail(id) {
    return apiClient.get(`/emails/${id}`);
  },
  postEmail(email) {
    return apiClient.post('/emails', email);
  },
};
