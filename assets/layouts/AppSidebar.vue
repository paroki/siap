<template>
  <CSidebar
      position="fixed"
      :unfoldable="sidebarUnfoldable"
      :visible="sidebarVisible"
      @visible-change="
      (event) =>
        $store.commit({
          type: 'updateSidebarVisible',
          value: event,
        })
    "
  >
    <CSidebarBrand>
      <CIcon
          custom-class-name="sidebar-brand-full"
          :icon="logoNegative"
          :height="35"
      />
      <CIcon
          custom-class-name="sidebar-brand-narrow"
          :icon="sygnet"
          :height="35"
      />
    </CSidebarBrand>
    <AppSidebarNav />
    <CSidebarToggler
        class="d-none d-lg-flex"
        @click="$store.commit('toggleUnfoldable')"
    />
  </CSidebar>
</template>
<script>
import { computed } from 'vue'
import { useStore } from 'vuex'
import { AppSidebarNav } from './AppSidebarNav'
import { logoNegative } from '../styles/brand/logo-negative'
import { sygnet } from '../styles/brand/sygnet'

export default {
  name: 'AppSidebar',
  components: {
    AppSidebarNav
  },
  setup(){
    const store = useStore()
    return {
      logoNegative,
      sygnet,
      sidebarUnfoldable: computed(() => store.state.ui.sidebarUnfoldable),
      sidebarVisible: computed(() => store.state.ui.sidebarVisible),
    }
  }
}
</script>