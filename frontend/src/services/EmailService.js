import axios from 'axios'

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  withCredentials: false,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

export default {
  getEmailTransactions() {
    return apiClient.get('/emails')
  },
  getEvent(id) {
    return apiClient.get('/emails/' + id)
  },
  postEvent(email) {
    return apiClient.post('/emails', email)
  }
}