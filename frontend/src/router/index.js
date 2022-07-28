import Vue from 'vue';
import VueRouter from 'vue-router';
import TransactionsView from '../views/TransactionsView.vue';
import TransactionDetailView from '../views/TransactionDetailView.vue';
import TransactionsErrorView from '../views/TransactionsErrorView.vue';

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
  {
    path: '/error',
    name: 'TransactionsErrorView',
    props: true,
    component: TransactionsErrorView,
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
