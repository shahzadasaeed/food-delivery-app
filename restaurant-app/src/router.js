import { createRouter, createWebHistory } from 'vue-router';
import RestaurantList from './components/RestaurantList.vue';

const routes = [
  {
    path: '/',
    name: 'RestaurantList',
    component: RestaurantList
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;