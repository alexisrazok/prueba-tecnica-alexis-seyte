import { createRouter, createWebHistory } from 'vue-router';
import SuperHeroes from '@/views/super-hero/super-heroes.vue';
import SuperHeroProfile from '@/views/super-hero/super-hero-profile.vue';

const routes = [
    { path: '/', name:"super-hero.index",component: SuperHeroes },
    { path: '/super-hero/:id', name: 'super-hero.show', component: SuperHeroProfile },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
