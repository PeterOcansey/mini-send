import Vue from 'vue';
import Vuex from 'vuex';
import EmailService from '@/services/EmailService';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    emails: [],
    email: null,
    loading: true,
  },
  mutations: {
    ADD_EMAIL(state, email) {
      state.emails.push(email);
    },
    SET_EMAILS(state, emails) {
      state.emails = emails;
    },
    SET_EMAIL(state, email) {
      state.email = email;
    },
    SET_LOADING(state, status) {
      state.loading = status;
    },
  },
  actions: {
    createEmail({ commit }, email) {
      return EmailService.postEmail(email)
        .then(() => {
          commit('ADD_EMAIL', email);
          commit('SET_EMAIL', email);
        })
        .catch((error) => {
          throw error;
        });
    },
    fetchEmails({ commit }) {
      commit('SET_LOADING', true);
      return EmailService.getEmails()
        .then((response) => {
          console.log(response.data.data.data);
          commit('SET_EMAILS', response.data.data.data);
          commit('SET_LOADING', false);
        })
        .catch((error) => {
          commit('SET_LOADING', false);
          throw error;
        });
    },
    fetchEmail({ commit }, id) {
      const savedEmail = this.state.emails.find((email) => email.id === id);
      if (savedEmail) {
        commit('SET_EMAIL', savedEmail);
        return savedEmail;
      }
      return EmailService.getEmail(id)
        .then((response) => {
          commit('SET_EMAIL', response.data);
        })
        .catch((error) => {
          throw error;
        });
    },
  },
});
