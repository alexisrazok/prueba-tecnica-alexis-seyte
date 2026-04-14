import { createRouter, createWebHistory } from 'vue-router';
import SuperHeroList from '@/views/super-hero-list.vue';
import SuperHeroShow from '@/views/super-hero-show.vue';

const routes = [
    { path: '/', name:"super-hero.index",component: SuperHeroList },
    { path: '/super-hero/:id', name: 'super-hero.show', component: SuperHeroShow },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
