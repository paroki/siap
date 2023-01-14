<template>
  <div>
    <AppSidebar/>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      <AppHeader />
      <div class="body flex-grow-1 px-3">
        <CContainer lg>
          <router-view />
        </CContainer>
      </div>
      <AppFooter />
    </div>
  </div>
</template>
<script>
import AppSidebar from "./AppSidebar";
import AppHeader from './AppHeader';
import AppFooter from "./AppFooter";

export default {
  components: {AppFooter, AppSidebar, AppHeader}
}
</script>