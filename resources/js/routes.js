import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import Login from './views/auth/Login.vue'
import Register from './views/auth/Register.vue'

import Header from './views/layouts/Header.vue'
import Footer from './views/layouts/Footer.vue'

import Dashboard from './views/Dashboard.vue'
// import Home from './views/Home.vue'

// USER
import Pembayaran from './views/Pembayaran.vue'
import Report from './views/Report.vue'
import KurbanSaya from './views/Kurban Saya.vue'
import Checkout from './views/Checkout.vue'
import ProfileCompletion from './views/ProfileCompletion.vue'
import ChooseMorePackage from './views/ChooseMorePackage.vue'
import ChoosePackage from './views/ChoosePackage.vue'
import TransactionSuccess from './views/TransactionSuccess.vue'

// ADMIN
import PembayaranKurban from './views/admin/Pembayaran.vue'
import Laporan from './views/admin/Laporan.vue'
import LaporanDetail from './views/admin/Laporan Detail.vue'
import LaporanCreate from './views/admin/Laporan Create.vue'
import LaporanEdit from './views/admin/Laporan Edit.vue'
import Pengiriman from './views/admin/Pengiriman.vue'
import Sertifikat from './views/admin/Sertifikat.vue'
import SertifikatCreate from './views/admin/Sertifikat Create.vue'

Vue.use(VueRouter)

const routes = [
    // AUTH
    {
        path: '/login',
        name: 'login',
        components: { default: Login, header: Header, footer: Footer }
    },
    {
        path: '/register',
        name: 'register',
        components: { default: Register, header: Header, footer: Footer }
    },
    {
        path: '/',
        name: 'Dashboard',
        components: { default: Dashboard, header: Header, footer: Footer },
        meta: {
            title: "Dashboard",
            requiresAuth: true
        }
    },

    // ADMIN
    {
        path: '/create/:id',
        name: 'Create Certificate',
        components: { default: SertifikatCreate, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/sertifikat',
        name: 'Sertifikat',
        components: { default: Sertifikat, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/laporan/pengiriman/:id_pembayaran',
        name: 'Pengiriman',
        components: { default: Pengiriman, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/laporan/:id_pembayaran/:id_laporan',
        name: 'reportEdit',
        components: { default: LaporanEdit, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/laporan/create/:id_pembayaran',
        name: 'reportCreate',
        components: { default: LaporanCreate, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/laporan/:id_pembayaran',
        name: 'reportDetail',
        components: { default: LaporanDetail, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/laporan',
        name: 'Laporan',
        components: { default: Laporan, footer: Footer, header: Header },
        meta: {
            requiresAuth: true
        }
    },

    // USER
    {
        path: '/kurbanSaya',
        name: 'Kurban Saya',
        components: { default: KurbanSaya, header: Header, footer: Footer },
        meta: {
            title: "Kurban Saya",
            requiresAuth: true
        }
    },
    {
        path: '/report/:id_pembayaran',
        name: 'Report',
        components: { default: Report, header: Header, footer: Footer },
        meta: {
            title: "Report",
            requiresAuth: true
        }
    },
    {
        path: '/pembayaranKurban',
        name: 'Pembayaran Kurban',
        components: { default: PembayaranKurban, header: Header, footer: Footer },
        meta: {
            title: "Pembayaran Kurban",
            requiresAuth: true
        }
    },
    {
        path: '/pembayaran',
        name: 'Pembayaran',
        components: { default: Pembayaran, header: Header, footer: Footer },
        meta: {
            title: "Pembayaran",
            requiresAuth: true
        }
    },
    {
        path: '/checkout',
        name: 'Checkout',
        components: { default: Checkout, header: Header, footer: Footer },
        meta: {
            title: "Checkout",
            requiresAuth: true
        }
    },
    {
        path: '/transactionSuccess',
        name: 'Transaction Success',
        components: { default: TransactionSuccess, header: Header },
        meta: {
            title: "Transaction Success",
            requiresAuth: true
        }
    },
    {
        path: '/choosePackage/:type',
        name: 'Choose More Packages',
        components: { default: ChooseMorePackage, header: Header, footer: Footer },
        meta: {
            title: "Choose More Packages",
            requiresAuth: true
        }
    },
    {
        path: '/choosePackage',
        name: 'Choose Package',
        components: { default: ChoosePackage, header: Header, footer: Footer },
        meta: {
            title: "Choose Package",
            requiresAuth: true
        }
    },
    {
        path: '/profileCompletion',
        name: 'Profile Completion',
        components: { default: ProfileCompletion, header: Header, footer: Footer },
        meta: {
            title: "Profile Completion",
            requiresAuth: true
        }
    },
    // {
    //     path: '/home',
    //     name: 'home',
    //     components: { default: Home, header: Header, footer: Footer },
    //     meta: {
    //         title: "Home",
    //         requiresAuth: true
    //     }
    // }
]

const router = new VueRouter({
    mode: 'hash',
    base: process.env.BASE_URL,
    routes: routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

export default router
