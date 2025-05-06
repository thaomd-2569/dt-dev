<!-- components/organisms/Header.vue -->
<template>
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <button class="sidebar-toggle" @click="toggleSidebar">
                    <span class="toggle-icon"></span>
                </button>
                <div class="logo">
                    <h1>Admin Dashboard</h1>
                </div>
            </div>
            <div class="header-right">
                <div class="search-container">
                    <input type="text" placeholder="Search..." />
                    <button class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
                <div class="notifications">
                    <button class="notification-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge" v-if="notificationCount > 0">{{ notificationCount }}</span>
                    </button>
                </div>
                <div class="user-menu" ref="userMenuRef">
                    <button class="user-button" @click="toggleUserMenu">
                        <div class="avatar">
                            <img src="https://i.pravatar.cc/100" alt="User avatar" />
                        </div>
                        <span class="username">{{ authStore.user.role }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="chevron-icon">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="dropdown-menu" v-if="isUserMenuOpen">
                        <NuxtLink to="/profile" class="dropdown-item">Profile</NuxtLink>
                        <NuxtLink to="/settings" class="dropdown-item">Settings</NuxtLink>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item logout" @click="logout">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import appRouters from '~/constants/appRouters'

const isUserMenuOpen = ref(false);
const notificationCount = ref(3);
const userMenuRef = ref(null);
const authStore = useAuthStore()

// Define user data to match what's shown in the screenshot
console.log('user', authStore.user.role)

const toggleUserMenu = () => {
    isUserMenuOpen.value = !isUserMenuOpen.value;
};

const toggleSidebar = () => {
    // Emit an event to toggle the sidebar
    emit('toggle-sidebar');
};

const logout = async () => {
    await authStore.logout()
    // authStore.clearLocalStorage()
    return navigateTo(appRouters.LOGIN)
};

// Define the event to be emitted
const emit = defineEmits(['toggle-sidebar']);

// Handle clicks outside of user menu
const handleClickOutside = (event) => {
    if (userMenuRef.value && !userMenuRef.value.contains(event.target) && isUserMenuOpen.value) {
        isUserMenuOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<style scoped>
.header {
    background-color: #ffffff;
    border-bottom: 1px solid #e9ecef;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 0;
    z-index: 1000;
    height: 60px;
    width: 100%;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1.5rem;
    height: 100%;
    width: 100%;
}

.header-left,
.header-right {
    display: flex;
    align-items: center;
}

.sidebar-toggle {
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    margin-right: 1rem;
    color: #333;
}

.toggle-icon {
    position: relative;
    width: 18px;
    height: 2px;
    background-color: currentColor;
}

.toggle-icon::before,
.toggle-icon::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 2px;
    background-color: currentColor;
    left: 0;
}

.toggle-icon::before {
    top: -5px;
}

.toggle-icon::after {
    bottom: -5px;
}

.logo h1 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
}

.search-container {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    border-radius: 20px;
    padding: 0 0.75rem;
    margin-right: 1rem;
    width: 240px;
}

.search-container input {
    background: none;
    border: none;
    padding: 0.5rem;
    width: 100%;
    outline: none;
    font-size: 0.9rem;
    color: #333;
}

.search-button {
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
}

.notification-button {
    background: none;
    border: none;
    cursor: pointer;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    margin-right: 1rem;
    color: #333;
}

.notification-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background-color: #ff5252;
    color: white;
    border-radius: 50%;
    font-size: 0.7rem;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.user-menu {
    position: relative;
}

.user-button {
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 4px;
}

.user-button:hover {
    background-color: #f5f5f5;
}

.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 8px;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.username {
    margin: 0 8px;
    font-size: 0.95rem;
    color: #333;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    border: 1px solid #e9ecef;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    min-width: 180px;
    margin-top: 8px;
    z-index: 1010;
}

.dropdown-item {
    display: block;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: #333;
    font-size: 0.95rem;
    transition: background-color 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f5f5f5;
}

.dropdown-divider {
    height: 1px;
    background-color: #e9ecef;
    margin: 0.5rem 0;
}

.logout {
    color: #ff5252;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 0.95rem;
}

.chevron-icon {
    transition: transform 0.2s ease;
}

@media (max-width: 768px) {
    .search-container {
        width: 150px;
    }

    .username {
        display: none;
    }
}

@media (max-width: 576px) {
    .search-container {
        display: none;
    }

    .header-content {
        padding: 0 1rem;
    }
}
</style>
