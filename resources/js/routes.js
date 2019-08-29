import App from './components/App'
import Index from './components/Index'
import Verify from './components/Verify'

import User from './components/User/User'
import UserDashboard from './components/User/UserDashboard'
import UserEvent from './components/User/UserEvent'
import UserProfile from './components/User/UserProfile'
import UserManageEvent from './components/User/UserManageEvent'
import EventDetail from './components/User/EventDetail'

import Admin from './components/Admin/Admin'
import AdminDashboard from './components/Admin/AdminDashboard'
import AdminManageEvent from './components/Admin/AdminManageEvent'
import AdminManageUser from './components/Admin/AdminManageUser'
import AdminMessage from './components/Admin/AdminMessage'



export const routes = [
    {
        path: '/',
        name: 'index',
        component: Index,
        
    },
    {
        path: '/login',
        redirect: '/'
        
    },
    {
        path: '/verify',
        name: 'verify',
        component: Verify,
        
    },

    //USER AREA
    {
        path: '/user',
        name: 'user',
        component: User,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'userdashboard',
                component: UserDashboard,
            }, 
            {
                path: '/event',
                name: 'userevent',
                component: UserEvent,
            },
            {
                path: '/profile',
                name: 'userprofile',
                component: UserProfile,
            },
            {
                path: '/manageevent',
                name: 'usermanageevent',
                component: UserManageEvent,
            },
            {
                path: '/event/:id',
                name: 'eventdetail',
                component: EventDetail,
                props: true,
            },
            
        ]
        // // props: { title: "This is the SPA home" }
    },
    // {
    //     path: '/event',
    //     name: 'userevent',
    //     component: UserEvent,
    // },

    //ADMIN AREA
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'admindashboard',
                component: AdminDashboard,
            }, 
            {
                path: '/adminmanageevent',
                name: 'adminmanageevent',
                component: AdminManageEvent,
            }, 
            {
                path: '/adminmanageuser',
                name: 'adminmanageuser',
                component: AdminManageUser,
            }, 
            {
                path: '/adminmessage',
                name: 'adminmessage',
                component: AdminMessage,
            },
        ]
    },



];