import axios from 'axios';

const apiClient = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL,
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
  postEmail(payload) {
    return apiClient.post('/emails', payload, { headers: { 'Content-Type': 'multipart/form-data' } });
  },
};
