<template>
    <q-layout>

        <q-layout-header>
            <q-toolbar color="tertiary">
                <q-btn flat round dense icon="menu" @click="left = !left" class="q-mr-md"/>
                <q-toolbar-title>ADMIN<span slot="subtitle">Eshop Music</span></q-toolbar-title>
                <q-btn flat round dense icon="menu" @click="right = !right" class="q-mr-md"/>
            </q-toolbar>
        </q-layout-header>

        <q-layout-drawer v-model="left" side="left">
            <main-layout-drawer-left></main-layout-drawer-left>
        </q-layout-drawer>

        <q-page-container>
            <div class="row full-width justify-center">
                <router-view class="c-container" />
            </div>
        </q-page-container>

        <q-layout-drawer v-model="right" side="right">
            <main-layout-drawer-right></main-layout-drawer-right>
        </q-layout-drawer>

        <q-layout-footer>
            <div class="text-center q-pa-md">Copyright (C) 2018, ESHOP MUSIC</div>
        </q-layout-footer>
    </q-layout>
</template>

<script>
import MainLayoutDrawerLeft from 'components/layouts/Main/DrawerLeft.vue'
import MainLayoutDrawerRight from 'components/layouts/Main/DrawerRight.vue'

export default {
  components: {
    MainLayoutDrawerLeft,
    MainLayoutDrawerRight
  },
  computed: {
    left: {
      get () { return this.$store.state.moduleUI.layout.leftDrawerState },
      set (val) { this.$store.commit('moduleUI/updateLeftDrawerState', val) }
    },
    right: {
      get () { return this.$store.state.moduleUI.layout.rightDrawerState },
      set (val) { this.$store.commit('moduleUI/updateRightDrawerState', val) }
    }
  }
}
</script>
