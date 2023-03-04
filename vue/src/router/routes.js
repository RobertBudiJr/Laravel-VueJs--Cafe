// import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
import AdminDashboardLayout from "@/layout/dashboard/AdminDashboardLayout.vue";
import ManajerDashboardLayout from "@/layout/dashboard/ManajerDashboardLayout.vue";

// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Default pages import
// const Dashboard = () =>
//   import(/* webpackChunkName: "dashboard" */ "@/pages/Dashboard.vue");
// const Profile = () =>
//   import(/* webpackChunkName: "common" */ "@/pages/Profile.vue");
// const Notifications = () =>
//   import(/* webpackChunkName: "common" */ "@/pages/Notifications.vue");
// const Icons = () =>
//   import(/* webpackChunkName: "common" */ "@/pages/Icons.vue");
// const Maps = () => import(/* webpackChunkName: "common" */ "@/pages/Maps.vue");
// const Typography = () =>
//   import(/* webpackChunkName: "common" */ "@/pages/Typography.vue");
// const TableList = () =>
//   import(/* webpackChunkName: "common" */ "@/pages/TableList.vue");

// Admin pages import
const AdminDashboard = () =>
  import(
    /* webpackChunkName: "admin dashboard" */ "@/pages/Admin/AdminDashboard.vue"
  );
const AdminIcons = () =>
  import(/* webpackChunkName: "common" */ "@/pages/Admin/AdminIcons.vue");
const AdminMenu = () =>
  import(/* webpackChunkName: "common" */ "@/pages/Admin/AdminMenu.vue");
const AdminUser = () =>
  import(/* webpackChunkName: "common" */ "@/pages/Admin/AdminUser.vue");
const AdminTable = () =>
  import(/* webpackChunkName: "common" */ "@/pages/Admin/AdminTable.vue");

// Kasir pages import

// Manajer pages import
const ManajerDashboard = () =>
  import(
    /* webpackChunkName: "manajer dashboard" */ "@/pages/Manajer/ManajerDashboard.vue"
  );
const ManajerIcons = () =>
  import(/* webpackChunkName: "common" */ "@/pages/Manajer/ManajerIcons.vue");

const routes = [
  // Default pages
  // {
  //   path: "/",
  //   component: DashboardLayout,
  //   redirect: "dashboard",
  //   children: [
  //     {
  //       path: "dashboard",
  //       name: "dashboard",
  //       component: Dashboard,
  //     },
  //     {
  //       path: "profile",
  //       name: "profile",
  //       component: Profile,
  //     },
  //     {
  //       path: "notifications",
  //       name: "notifications",
  //       component: Notifications,
  //     },
  //     {
  //       path: "icons",
  //       name: "icons",
  //       component: Icons,
  //     },
  //     {
  //       path: "maps",
  //       name: "maps",
  //       component: Maps,
  //     },
  //     {
  //       path: "typography",
  //       name: "typography",
  //       component: Typography,
  //     },
  //     {
  //       path: "table-list",
  //       name: "table-list",
  //       component: TableList,
  //     },
  //   ],
  // },
  // Admin Pages
  {
    path: "/admin",
    component: AdminDashboardLayout,
    redirect: "admindashboard",
    children: [
      {
        path: "admindashboard",
        name: "admin dashboard",
        component: AdminDashboard,
      },
      {
        path: "adminicons",
        name: "admin icons",
        component: AdminIcons,
      },
      {
        path: "adminmenu",
        name: "admin menu",
        component: AdminMenu,
      },
      {
        path: "adminuser",
        name: "admin user",
        component: AdminUser,
      },
      {
        path: "admintable",
        name: "admin table",
        component: AdminTable,
      },
    ],
  },
  // Manajer Pages
  {
    path: "/manajer",
    component: ManajerDashboardLayout,
    redirect: "manajerdashboard",
    children: [
      {
        path: "manajerdashboard",
        name: "manajer dashboard",
        component: ManajerDashboard,
      },
      {
        path: "manajericons",
        name: "manajer icons",
        component: ManajerIcons,
      },
    ],
  },
  { path: "*", component: NotFound },
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
