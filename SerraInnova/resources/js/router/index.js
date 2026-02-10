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
import Blog from '../views/Blog.vue';
import BlogDetail from '../views/BlogDetail.vue';

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
        props: true,
    },
    {
        path: '/calculadora',
        name: 'Calculator',
        component: Calculator,
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
    {
        path: '/servicios',
        name: 'Services',
        component: () => import('../views/Services.vue'),
    },
    {
        path: '/contacto',
        name: 'Contacto',
        component: () => import('../views/Contacto.vue'),
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
    // Blog Routes
    {
        path: '/blog',
        name: 'Blog',
        component: Blog,
    },
    {
        path: '/blog/:slug',
        name: 'BlogDetail',
        component: BlogDetail,
    },
    // Admin Blog Routes
    {
        path: '/admin/blog',
        name: 'AdminBlog',
        component: () => import('../views/AdminBlog.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/blog/create',
        name: 'AdminBlogCreate',
        component: () => import('../views/AdminBlogForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
    {
        path: '/admin/blog/:id/edit',
        name: 'AdminBlogEdit',
        component: () => import('../views/AdminBlogForm.vue'),
        meta: { requiresAuth: true, requiresAdmin: true }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // Si hay una posición guardada (por ejemplo, al usar el botón "atrás" del navegador)
        if (savedPosition) {
            return savedPosition;
        }
        // Si hay un hash en la URL (por ejemplo, #seccion)
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth',
            };
        }
        // Por defecto, siempre scroll al inicio
        return { top: 0, behavior: 'smooth' };
    },
});

// Guard de navegación
router.beforeEach((to, from, next) => {
    const user = JSON.parse(localStorage.getItem('user') || 'null');

    // Si el usuario está autenticado y trata de entrar a Login o Register -> Redirigir a Home
    if (user && (to.name === 'Login' || to.name === 'Register')) {
        next('/');
    }
    // Si requiere ser Admin y no lo es
    else if (to.meta.requiresAdmin && user?.tipo_usuario !== 'administrador') {
        next('/');
    }
    // Si la ruta requiere ser agente y el usuario no lo es
    else if (to.meta.requiresAgente && user?.tipo_usuario !== 'agente') {
        next('/');
    }
    // Si la ruta requiere autenticación (Profile, SellProperty) y no hay usuario -> Redirigir a Login
    else if (to.meta.requiresAuth && !user) {
        next('/login');
    }
    // Permitir acceso
    else {
        next();
    }
});

export default router;