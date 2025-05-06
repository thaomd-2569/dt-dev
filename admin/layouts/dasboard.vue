<!-- layouts/dashboard.vue -->
<template>
    <div>
      <AppHeader />
      <div class="dashboard-content">
        <slot />
      </div>
      <AppFooter />
    </div>
  </template>

  <script setup>
  import AppHeader from '~/components/AppHeader.vue'
  import AppFooter from '~/components/AppFooter.vue'
  </script>
