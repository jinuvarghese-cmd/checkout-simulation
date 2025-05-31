<template>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <template v-if="order.status === 'approved'">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="mt-3 text-3xl font-extrabold text-gray-900">Order Confirmed!</h1>
                <p class="mt-2 text-lg text-gray-600">Thank you for your purchase!</p>
            </template>
            
            <template v-else-if="order.status === 'declined'">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h1 class="mt-3 text-3xl font-extrabold text-gray-900">Order Declined</h1>
                <p class="mt-2 text-lg text-gray-600">Your payment was declined. Please try again.</p>
            </template>
            
            <template v-else>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h1 class="mt-3 text-3xl font-extrabold text-gray-900">Payment Failed</h1>
                <p class="mt-2 text-lg text-gray-600">There was an issue processing your payment. Please try again.</p>
            </template>
            
            <div class="mt-8">
                <p class="text-sm font-medium text-gray-500">Order number</p>
                <p class="mt-1 text-2xl font-extrabold text-gray-900">{{ order.order_number }}</p>
            </div>
        </div>
        
        <!-- Order Details -->
        <div class="mt-16 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Order Information</h3>
            </div>
            
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <!-- Customer Info -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Customer Information</h4>
                        
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Name:</span> {{ order.full_name }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Email:</span> {{ order.email }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Phone:</span> {{ order.phone }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Shipping Info -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-4">Shipping Information</h4>
                        
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">Address:</span> {{ order.address }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">City:</span> {{ order.city }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">State:</span> {{ order.state }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium">ZIP Code:</span> {{ order.zip_code }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="mt-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Order Summary</h4>
                    
                    <div class="space-y-6">
                        <div v-for="item in order.items" :key="item.id" class="flex items-start">
                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-md overflow-hidden">
                                <img :src="item.product.image_url" :alt="item.product.name" class="w-full h-full object-cover">
                            </div>
                            
                            <div class="ml-4 flex-1">
                                <div class="flex justify-between">
                                    <h5 class="text-sm font-medium text-gray-900">{{ item.product.name }}</h5>
                                    <p class="ml-4 text-sm font-medium text-gray-900">${{ item.price }}</p>
                                </div>
                                
                                <div v-if="item.variant_options" class="mt-1 text-sm text-gray-600">
                                    <p v-for="(value, name) in item.variant_options" :key="name">
                                        {{ name }}: {{ value }}
                                    </p>
                                </div>
                                
                                <p class="mt-1 text-sm text-gray-600">Quantity: {{ item.quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Total -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex justify-between">
                        <span class="text-base font-medium text-gray-900">Subtotal</span>
                        <span class="text-base font-medium text-gray-900">${{ order.total }}</span>
                    </div>
                    
                    <div class="flex justify-between mt-2">
                        <span class="text-base font-medium text-gray-900">Shipping</span>
                        <span class="text-base font-medium text-gray-900">$0.00</span>
                    </div>
                    
                    <div class="flex justify-between mt-4 border-t border-gray-200 pt-4">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-gray-900">${{ order.total }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Additional Messages -->
            <div class="px-4 py-4 sm:px-6 bg-gray-50">
                <template v-if="order.status === 'approved'">
                    <p class="text-sm text-gray-600">
                        Your order has been confirmed and will be shipped soon. A confirmation email has been sent to {{ order.email }}.
                    </p>
                </template>
                
                <template v-else-if="order.status === 'declined'">
                    <p class="text-sm text-gray-600">
                        Your payment was declined. Please check your payment information and try again, or contact your bank for assistance.
                    </p>
                </template>
                
                <template v-else>
                    <p class="text-sm text-gray-600">
                        There was an issue processing your payment. Please try again or contact our support team for assistance.
                    </p>
                </template>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <button
                @click="goBackToHome"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Back to Home
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

const order = ref({
    order_number: '',
    status: '',
    full_name: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    zip_code: '',
    total: 0,
    items: [],
});

onMounted(async () => {
    try {
        const response = await axios.get(`/api/orders/${route.params.orderNumber}`);
        order.value = response.data;
 
    } catch (error) {
        console.error('Error fetching order:', error);
        router.push({ name: 'landing' });
    }
});

const goBackToHome = () => {
    router.push({ name: 'landing' });
};
</script>