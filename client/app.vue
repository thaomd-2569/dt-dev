<script setup>
import Header from '~/components/layouts/Header.vue'
import Footer from '~/components/layouts/Footer.vue'
</script>

<template>
  <div class="flex flex-col min-h-screen">
      <Header />
      <main class="flex-grow">
          <NuxtPage />
      </main>
      <Footer />
  </div>
</template>
