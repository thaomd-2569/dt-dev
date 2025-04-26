<template>
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">MySite</h1>
            <nav class="space-x-4">
                <NuxtLink to="/" class="text-gray-600 hover:text-black">Home</NuxtLink>
                <NuxtLink to="/about" class="text-gray-600 hover:text-black">About</NuxtLink>
                <NuxtLink to="/contact" class="text-gray-600 hover:text-black">Contact</NuxtLink>
            </nav>
        </div>
    </header>
</template>
