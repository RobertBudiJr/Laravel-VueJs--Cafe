<template>
  <div class="wrapper">
    <side-bar>
      <template slot="links">
        <sidebar-link
          to="/admin/admindashboard"
          :name="$t('sidebar.dashboard')"
          icon="tim-icons icon-chart-pie-36"
        />
        <sidebar-link
          to="/admin/adminmenu"
          :name="$t('menu')"
          icon="tim-icons icon-bullet-list-67"
        />
        <sidebar-link
          to="/admin/adminuser"
          :name="$t('user')"
          icon="tim-icons icon-single-02"
        />
        <sidebar-link
          to="/admin/admintable"
          :name="$t('table')"
          icon="tim-icons icon-calendar-60"
        />
        <sidebar-link
          to="/admin/adminicons"
          :name="$t('sidebar.icons')"
          icon="tim-icons icon-atom"
        />
      </template>
    </side-bar>
    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content @click.native="toggleSidebar"> </dashboard-content>

      <content-footer></content-footer>
    </div>
  </div>
</template>
<style lang="scss"></style>
<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "./MobileMenu";
export default {
  components: {
    TopNavbar,
    ContentFooter,
    DashboardContent,
    MobileMenu,
  },
  methods: {
    toggleSidebar() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
  },
};
</script>
