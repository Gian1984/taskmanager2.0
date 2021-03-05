// import Home from './components/Home'
import Index from './components/Index'
import Login from './components/Login'
import Register from './components/Register'
import Dashboard from './components/Dashboard'
import Projects from './components/Projects'
import Notfound from './components/Notfound'
import Team from './components/Team'
import axios from 'axios'

export default {

    mode: 'history',

    routes: [{
            path: '*',
            component: Notfound
        },

        {
            path: '/login',
            component: Login,
            name: 'Login',
        },

        {
            path: '/register',
            component: Register,
            name: 'Register',
        },

        {
            path: '/dashboard',
            component: Dashboard,
            name: 'Dashboard',
            beforeEnter: (to, form, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({ name: 'Login' })
                })
            }

        },


        {
            path: '/',
            component: Index
        },

        {
            path: '/team',
            component: Team,
            name: 'Team',
            beforeEnter: (to, form, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({ name: 'Login' })
                })
            }
        },

        {
            path: '/projects',
            component: Projects,
            name: 'Projects',
            beforeEnter: (to, form, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({ name: 'Login' })
                })
            }
        }
    ]
}