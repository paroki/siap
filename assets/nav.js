export default [
    {
        component: 'CNavItem',
        name: 'Dashboard',
        to: '/dashboard',
        icon: 'cil-speedometer',
    },
    {
        component: "CNavGroup",
        name: 'Sakramen',
        icon: 'cil-star',
        to: '/sakramen',
        items: [
            {
                component: 'CNavItem',
                name: 'Baptis',
                to: '/baptis'
            },
            {
                component: 'CNavItem',
                name: 'Komuni',
                to: '/komuni'
            },
            {
                component: 'CNavItem',
                name: 'Krisma',
                to: '/krisma'
            },
            {
                component: 'CNavItem',
                name: 'Perkawinan',
                to: '/perkawinan'
            },
            {
                component: 'CNavItem',
                name: 'Perminyakan',
                to: '/perminyakan'
            },
        ]
    },
    {
        component: "CNavGroup",
        name: 'Profile',
        icon: 'cil-user',
        to: '/profile',
        items: [
            {
                component: 'CNavItem',
                name: 'Update Password',
                to: '/profile/update-password'
            },
        ]
    },
    {
        component: 'CNavItem',
        name: 'Logout',
        to: '/logout',
        icon: 'cil-speedometer'
    }
]