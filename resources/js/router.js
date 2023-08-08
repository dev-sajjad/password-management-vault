import { createWebHistory, createRouter } from "vue-router";
import Vault from "./pages/Vault.vue";
import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import Tool from "./pages/Tool.vue";

import AllVaultData from "./components/AllVaultData.vue";
import AllLoginData from "./components/AllLoginData.vue";
import AllCardData from "./components/AllCardData.vue";
import AllIdentityData from "./components/AllIdentityData.vue";
import PasswordGenerator from "./components/PasswordGenerator.vue";
import ExportData from "./components/ExportData.vue";
import ImportData from "./components/ImportData.vue";

const routes = [
    {
        path: "/",
        redirect: '/all',
        component: Vault,
        meta: {
            auth: true,
        },
        children: [
            {
                path: "/all",
                component: AllVaultData,
            },
            {
                path: "login",
                component: AllLoginData,
            },
            {
                path: "card",
                component: AllCardData,
            },
            {
                path: "identity",
                component: AllIdentityData,
            },
        ],
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            auth: false,
        },
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {
            auth: false,
        },
    },
    {
        path: "/tools",
        redirect: '/tools/generator',
        component: Tool,
        meta: {
            auth: true,
        },
        children: [
            {
                path: 'generator',
                component: PasswordGenerator
            },
            {
                path: 'export',
                component: ExportData
            },
            {
                path: 'import',
                component: ImportData
            }
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'active',
});


router.beforeEach((to, from) => {
    if (to.meta.auth && !localStorage.getItem('token')) {
        return { name: 'Login'}
    }
    if (to.meta.auth == false && localStorage.getItem('token')) {
        return '/'
    }
})

export default router;
