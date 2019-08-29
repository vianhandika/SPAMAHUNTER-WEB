import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes'

import Dashboard from './components/UserDashboard'
import User from './components/User'
import UserDashboard from './components/UserDashboard'
import UserEvent from './components/UserEvent'

// import App from './components/App'
// import Welcome from './components/Welcome'
// import Page from './components/Page'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes,
});


new Vue({
    el: '#app',
    router,
    render: h => h(User)
})
.$mount('#app');