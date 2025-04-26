<template>
    <footer class="bg-white border rounded-lg shadow mt-12">
        <div class="max-w-screen-xl mx-auto p-6 text-center">
            <!-- Top Links -->
            <div class="flex flex-wrap justify-center space-x-6 text-sm text-gray-500 mb-6">
                <NuxtLink to="/" class="hover:underline">About</NuxtLink>
                <NuxtLink to="/blog" class="hover:underline">Blog</NuxtLink>
                <NuxtLink to="/jobs" class="hover:underline">Jobs</NuxtLink>
                <NuxtLink to="/press" class="hover:underline">Press</NuxtLink>
                <NuxtLink to="/accessibility" class="hover:underline">Accessibility</NuxtLink>
                <NuxtLink to="/partners" class="hover:underline">Partners</NuxtLink>
            </div>

            <!-- Social Icons -->
            <div class="flex justify-center space-x-6 mb-6 text-gray-500">
                <a href="#" class="hover:text-gray-700"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-gray-700"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-gray-700"><i class="fab fa-x-twitter"></i></a>
                <a href="#" class="hover:text-gray-700"><i class="fab fa-github"></i></a>
                <a href="#" class="hover:text-gray-700"><i class="fab fa-youtube"></i></a>
            </div>

            <!-- Copyright -->
            <p class="text-sm text-gray-400">
                © {{ new Date().getFullYear() }} Your Company, Inc. All rights reserved.
            </p>
        </div>
    </footer>
</template>

<script setup>
// You can customize this year logic or hardcode if needed
</script>
