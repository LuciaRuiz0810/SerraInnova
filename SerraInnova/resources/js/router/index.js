import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Properties from '../views/Properties.vue';
import PropertyDetail from '../views/PropertyDetail.vue';
import About from '../views/About.vue';
import Agents from '../views/Agents.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/propiedades',
        name: 'Properties',
        component: Properties,
    },
    {
        path: '/propiedades/:id',
        name: 'PropertyDetail',
        component: PropertyDetail,
        props: true
    },
    {
        path: '/nosotros',
        name: 'About',
        component: About,
    },
    {
        path: '/agentes',
        name: 'Agents',
        component: Agents,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
