<template>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo/Home Link -->
                    <router-link 
                        to="/" 
                        class="flex items-center text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        eCommerce
                    </router-link>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-8">
                        <router-link 
                            to="/" 
                            class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors"
                            active-class="text-indigo-600 font-medium"
                        >
                            Home
                        </router-link>
                    </nav>

                    <!-- Cart Icon -->
                    <router-link 
                        to="/checkout" 
                        class="relative p-2 text-gray-400 hover:text-gray-500 transition-colors"
                        aria-label="Shopping cart"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span 
                            v-if="cart.totalItems > 0"
                            class="absolute -top-1 -right-1 bg-indigo-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                        >
                            {{ cart.totalItems }}
                        </span>
                    </router-link>

                    <!-- Mobile menu button -->
                    <button 
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="md:hidden p-2 text-gray-400 hover:text-gray-500 focus:outline-none"
                        aria-label="Open menu"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div 
                v-show="isMobileMenuOpen"
                class="md:hidden bg-white border-t border-gray-200"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <router-link 
                        to="/" 
                        @click="isMobileMenuOpen = false"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-colors"
                        active-class="text-indigo-600 bg-indigo-50"
                    >
                        Home
                    </router-link>

                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <router-view />
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-8">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    &copy; {{ new Date().getFullYear() }} eCommerce Checkout. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useCartStore } from '@/stores/cart';

const cart = useCartStore();
const isMobileMenuOpen = ref(false);
</script>
