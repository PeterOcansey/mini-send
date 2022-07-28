import { createStore } from 'vuex'
import EmailService from '@/services/EmailService'

export default createStore({
  state: {
    emails: [],
    email: null
  },
  mutations: {
    ADD_EMAIL(state, email) {
      state.emails.push(email)
    },
    SET_EMAILS(state, emails) {
      state.emails = emails
    },
    SET_EMAIL(state, email) {
      state.email = email
    }
  },
  actions: {
    createEmail({ commit }, email) {
      return EmailService.postEmail(email)
        .then(() => {
          commit('ADD_EMAIL', email)
          commit('SET_EMAIL', email)
        })
        .catch(error => {
          throw error
        })
    },
    fetchEmails({ commit }) {
      return EmailService.getEmails()
        .then(response => {
          commit('SET_EMAILS', response.data)
        })
        .catch(error => {
          throw error
        })
    },
    fetchEmail({ commit }, id) {  
      const email = state.emails.find(email => email.id === id)
      if (email) {
        commit('SET_EMAIL', email)
      } else {
        return EmailService.getEmail(id)
          .then(response => {
            commit('SET_EMAIL', response.data)
          })
          .catch(error => {
            throw error
          })
      }
    }
  }
})
