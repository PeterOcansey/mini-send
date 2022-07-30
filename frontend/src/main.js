import Vue from 'vue';
import vuetify from '@/plugins/vuetify';
import Vue2Editor from 'vue2-editor';
import App from './App.vue';
import router from './router';
import store from './store';

Vue.config.productionTip = false;

new Vue({
  vuetify,
  router,
  store,
  Vue2Editor,
  render: (h) => h(App),
}).$mount('#app');
