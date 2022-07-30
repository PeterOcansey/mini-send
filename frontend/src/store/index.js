import Vue from 'vue';
import Vuex from 'vuex';
import EmailService from '@/services/EmailService';
import LOADERS from '@/utils/constants';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    emails: [],
    email: null,
    loading: LOADERS.OFF,
    response: null,
    paginator: null,
  },
  mutations: {
    ADD_EMAIL(state, email) {
      state.emails.unshift(email);
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
    SET_RESPONSE(state, response) {
      state.response = response;
    },
    SET_PAGINATOR(state, paginator) {
      state.paginator = paginator;
    },
  },
  getters: {
    getAllEmails: (state) => state.emails,
    getResponse: (state) => state.response,
    getPaginator: (state) => state.paginator,
  },
  actions: {
    createEmail({ commit }, email) {
      return EmailService.postEmail(email)
        .then((response) => {
          commit('ADD_EMAIL', response.data.data);
          commit('SET_EMAIL', response.data.data);
          commit('SET_LOADING', LOADERS.OFF);
        })
        .catch((error) => {
          commit('SET_LOADING', LOADERS.OFF);
          throw error;
        });
    },
    fetchEmails({ commit }, params) {
      return EmailService.getEmails(params)
        .then((response) => {
          console.log(response.data.data);
          commit('SET_EMAILS', response.data.data.data);
          commit('SET_LOADING', LOADERS.OFF);
          commit('SET_RESPONSE', response.data.data);
          commit('SET_PAGINATOR', {
            current_page: response.data.data.current_page,
            first_page_url: response.data.data.first_page_url,
            from: response.data.data.from,
            last_page: response.data.data.last_page,
            last_page_url: response.data.data.last_page_url,
            per_page: response.data.data.per_page,
            prev_page_url: response.data.data.prev_page_url,
            to: response.data.data.to,
            total: response.data.data.total,
          });
        })
        .catch((error) => {
          commit('SET_LOADING', LOADERS.OFF);
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
    setLoader({ commit }, status) {
      commit('SET_LOADING', status);
    },
  },
});
