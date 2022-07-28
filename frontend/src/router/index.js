import Vue from 'vue';
import VueRouter from 'vue-router';
import TransactionsView from '../views/TransactionsView.vue';
import TransactionDetailView from '../views/TransactionDetailView.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'transactions',
    component: TransactionsView,
  },
  {
    path: '/transactions/:id',
    name: 'TransactionDetailView',
    props: true,
    component: TransactionDetailView,
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
