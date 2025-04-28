<template>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <p>&copy; {{ currentYear }} Admin Dashboard. All rights reserved.</p>
            </div>
            <div class="footer-right">
                <span>Version 1.0.0</span>
                <nav class="footer-nav">
                    <NuxtLink to="/privacy">Privacy Policy</NuxtLink>
                    <NuxtLink to="/terms">Terms of Service</NuxtLink>
                    <NuxtLink to="/contact">Contact</NuxtLink>
                </nav>
            </div>
        </div>
    </footer>
</template>

<script setup>
const currentYear = computed(() => new Date().getFullYear());
</script>

<style scoped>
.footer {
    width: 100%;
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
    padding: 1rem 2rem;
    margin-top: auto;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-left p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.footer-right {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.footer-right span {
    color: #6c757d;
    font-size: 0.85rem;
}

.footer-nav {
    display: flex;
    gap: 1rem;
}

.footer-nav a {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s ease;
}

.footer-nav a:hover {
    color: #343a40;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        gap: 1rem;
    }

    .footer-right {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}
</style>
