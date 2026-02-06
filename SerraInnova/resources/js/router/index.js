import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Properties from '../views/Properties.vue';
import PropertyDetail from '../views/PropertyDetail.vue';
import About from '../views/About.vue';
import Agents from '../views/Agents.vue';
import Calculator from '../views/Calculator.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import SellProperty from '../views/SellProperty.vue';

const routes = [
    {
        path: '/admin/propiedades',
        name: 'AdminProperties',
        component: () => import('../views/AdminProperties.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/propiedades/create',
        name: 'AdminPropertyCreate',
        component: () => import('../views/AdminPropertyForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/propiedades/:id/edit',
        name: 'AdminPropertyEdit',
        component: () => import('../views/AdminPropertyForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    // Admin Agents Routes
    {
        path: '/admin/agentes',
        name: 'AdminAgents',
        component: () => import('../views/AdminAgents.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/agentes/nuevo',
        name: 'AdminCreateAgent',
        component: () => import('../views/AdminAgentForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/agentes/:id',
        name: 'AdminEditAgent',
        component: () => import('../views/AdminAgentForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    // Admin Users Routes
    {
        path: '/admin/usuarios',
        name: 'AdminUsers',
        component: () => import('../views/AdminUsers.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/usuarios/nuevo',
        name: 'AdminCreateUser',
        component: () => import('../views/AdminUserForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/usuarios/:id',
        name: 'AdminEditUser',
        component: () => import('../views/AdminUserForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/welcome',
        name: 'Welcome',
        component: () => import('../views/Welcome.vue'),
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/propiedades',
        name: 'Properties',
        component: Properties,
        meta: { requiresAuth: true }
    },
    {
        path: '/propiedades/:id',
        name: 'PropertyDetail',
        component: PropertyDetail,
        props: true,
        meta: { requiresAuth: true }
    },
    {
        path: '/calculadora',
        name: 'Calculator',
        component: Calculator,
        meta: { requiresAuth: true }
    },
    {
        path: '/nosotros',
        name: 'About',
        component: About,
        meta: { requiresAuth: true }
    },
    {
        path: '/agentes',
        name: 'Agents',
        component: Agents,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('../views/Register.vue'),
    },
    {
        path: '/perfil',
        name: 'Profile',
        component: () => import('../views/Profile.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/admin',
        name: 'AdminPanel',
        component: () => import('../views/AdminPanel.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/vender',
        name: 'SellProperty',
        component: () => import('../views/SellProperty.vue'),
        meta: { requiresAuth: true, role: 'agente' }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Guard de navegación
router.beforeEach((to, from, next) => {
    const user = JSON.parse(localStorage.getItem('user') || 'null');
    const guestOnlyRoutes = ['Welcome', 'Login', 'Register'];

    // Si el usuario está autenticado y trata de entrar a Welcome, Login o Register -> Redirigir a Home
    if (user && guestOnlyRoutes.includes(to.name)) {
        next('/');
    }
    // Si la ruta requiere auth y no hay usuario -> Redirigir a Welcome
    else if (to.meta.requiresAuth && !user) {
        next('/welcome');
    }
    // Si un invitado intenta entrar a cualquier ruta no definida como pública (protección extra)
    else if (!user && !guestOnlyRoutes.includes(to.name)) {
        next('/welcome');
    }
    // Si requiere ser Admin y no lo es
    else if (to.meta.requiresAdmin && user?.tipo_usuario !== 'administrador') {
        next('/');
    }
    // Si la ruta requiere ser agente y el usuario no lo es
    else if (to.meta.requiresAgente && user?.tipo_usuario !== 'agente') {
        next('/');
    }
    // Permitir acceso
    else {
        next();
    }
});

export default router;
