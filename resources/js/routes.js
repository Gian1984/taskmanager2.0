// import Home from './components/Home'
import Index from './components/Index'
import Login from './components/Login'
import Register from './components/Register'
import Dashboard from './components/Dashboard'
import Projects from './components/Projects'
import Notfound from './components/Notfound'
import Team from './components/Team'

export default {

    mode: 'history',

    routes: [{
            path: '*',
            component: Notfound
        },

        {
            path: '/login',
            component: Login
        },

        {
            path: '/register',
            component: Register
        },

        {
            path: '/dashboard',
            component: Dashboard,
            // name: 'Dashboard',
            // beforeEnter: (to, form, next) => {
            //     axios.get('/api/authenticated').then(() =>
            //         next()
            //     )
            // }.catch(() => {
            //         return next({ name: login })
            //     )
            // }

        },


        {
            path: '/',
            component: Index
        },

        {
            path: '/team',
            component: Team
        },

        {
            path: '/projects',
            component: Projects
        }
    ]
}