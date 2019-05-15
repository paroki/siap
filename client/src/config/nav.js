export default [
    {
        name: "Dashboard",
        icon: "mdi-view-dashboard"
    },
    {
        name: "Administrasi",
        icon: "mdi-settings",
        children: [
            {
                name: "UserList",
                label: "User",
                icon: "mdi-shield-check",
                url: "/user/"
            }
        ]
    }
];
