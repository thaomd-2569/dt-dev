<!-- layouts/dashboard.vue -->
<template>
    <div class="admin-layout">
        <Header @toggle-sidebar="toggleSidebar" />
        <div class="main-container">
            <aside class="sidebar" :class="{ 'sidebar-collapsed': isSidebarCollapsed }">
                <nav class="sidebar-nav">
                    <ul>
                        <li>
                            <NuxtLink to="/">Dashboard</NuxtLink>
                        </li>
                        <li>
                            <NuxtLink to="/categories">Category</NuxtLink>
                        </li>
                        <li>
                            <NuxtLink to="/products">Products</NuxtLink>
                        </li>
                        <li>
                            <NuxtLink to="/orders">Orders</NuxtLink>
                        </li>
                        <li>
                            <NuxtLink to="/settings">Settings</NuxtLink>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="content">
                <slot />
            </main>
        </div>
        <Footer />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Header from '~/components/organisms/Header.vue';
import Footer from '~/components/organisms/Footer.vue';

const isSidebarCollapsed = ref(false);

const toggleSidebar = () => {
    isSidebarCollapsed.value = !isSidebarCollapsed.value;
};

// definePageMeta({
//   layout: 'dashboard',
//   middleware: [
//     function (to, from) {
//     },
//   ],
// })
</script>

<style scoped>
.admin-layout {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.main-container {
    display: flex;
    flex: 1;
}

.sidebar {
    width: 250px;
    background-color: #212529;
    color: #fff;
    transition: width 0.3s ease;
    overflow-x: hidden;
}

.sidebar-collapsed {
    width: 0px;
}

.sidebar-nav {
    padding: 1rem 0;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav li {
    margin: 0;
    padding: 0;
}

.sidebar-nav a {
    display: block;
    padding: 0.75rem 1.5rem;
    color: #adb5bd;
    text-decoration: none;
    transition: all 0.2s ease;
}

.sidebar-nav a:hover,
.sidebar-nav a.router-link-active {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.1);
}

.content {
    flex: 1;
    padding: 2rem;
    background-color: #f8f9fa;
    overflow-y: auto;
}

@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        height: 100%;
        z-index: 999;
        left: 0;
        transform: translateX(-100%);
    }

    .sidebar.sidebar-collapsed {
        transform: translateX(0);
        width: 250px;
    }
}
</style>
