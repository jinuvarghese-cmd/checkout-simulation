<template>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <!-- Checkout Form -->
            <div class="mb-8 lg:mb-0">
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Checkout</h2>
                
                <form @submit.prevent="submitOrder">
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                        
                        <div class="grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input
                                    type="text"
                                    id="full_name"
                                    v-model="form.full_name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    v-model="form.email"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    v-model="form.phone"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                                <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Shipping Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h3>
                        
                        <div class="grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input
                                    type="text"
                                    id="address"
                                    v-model="form.address"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                            
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input
                                    type="text"
                                    id="city"
                                    v-model="form.city"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                            
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                <input
                                    type="text"
                                    id="state"
                                    v-model="form.state"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                            
                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                                <input
                                    type="text"
                                    id="zip_code"
                                    v-model="form.zip_code"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                        
                        <div class="grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                                <input
                                    type="text"
                                    id="card_number"
                                    v-model="form.card_number"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    @input="validateCardNumber"
                                >
                                <p v-if="errors.card_number" class="mt-1 text-sm text-red-600">{{ errors.card_number }}</p>
                            </div>
                            
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                                <input
                                    type="month"
                                    id="expiry_date"
                                    v-model="form.expiry_date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    @change="validateExpiryDate"
                                >
                                <p v-if="errors.expiry_date" class="mt-1 text-sm text-red-600">{{ errors.expiry_date }}</p>
                            </div>
                            
                            <div>
                                <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                <input
                                    type="text"
                                    id="cvv"
                                    v-model="form.cvv"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    @input="validateCvv"
                                >
                                <p v-if="errors.cvv" class="mt-1 text-sm text-red-600">{{ errors.cvv }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Transaction Simulation -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Transaction Simulation</h3>
                        
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input
                                    id="approved"
                                    v-model="form.simulate_result"
                                    type="radio"
                                    value="1"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                >
                                <label for="approved" class="ml-3 block text-sm font-medium text-gray-700">
                                    Approved Transaction
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <input
                                    id="declined"
                                    v-model="form.simulate_result"
                                    type="radio"
                                    value="2"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                >
                                <label for="declined" class="ml-3 block text-sm font-medium text-gray-700">
                                    Declined Transaction
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <input
                                    id="failed"
                                    v-model="form.simulate_result"
                                    type="radio"
                                    value="3"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                                >
                                <label for="failed" class="ml-3 block text-sm font-medium text-gray-700">
                                    Gateway Error / Failure
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 py-3 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :disabled="isSubmitting"
                    >
                        <span v-if="!isSubmitting">Complete Order</span>
                        <span v-else>Processing...</span>
                    </button>
                </form>
            </div>
            
            <!-- Order Summary -->
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Order Summary</h2>
                
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Cart Items -->
                        <div class="space-y-4 mb-4">
                            <div v-for="(item, index) in cartStore.cart" :key="index" class="border-b border-gray-200 pb-4 last:border-b-0">
                                <div class="flex items-start space-x-4">
                                    <img 
                                        :src="item.product.image_url" 
                                        :alt="item.product.name"
                                        class="w-16 h-16 object-cover rounded-md flex-shrink-0"
                                    >
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ item.product.name }}</h3>
                                    
                                    <!-- Rest of your existing product details -->
                                    <div class="space-y-1">
                                        <div v-for="(value, name) in item.variantOptions" :key="name" class="flex justify-between text-sm">
                                            <span class="text-gray-600">{{ name }}:</span>
                                            <span class="text-gray-900">{{ value }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Quantity:</span>
                                            <span class="text-gray-900">{{ item.quantity }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Price:</span>
                                            <span class="text-gray-900">${{ item.product.price }}</span>
                                        </div>
                                        
                                        <div class="flex justify-between text-sm font-medium">
                                            <span class="text-gray-900">Subtotal:</span>
                                            <span class="text-gray-900">${{ (item.product.price * item.quantity).toFixed(2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        <!-- Order Totals -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between">
                                <span class="text-base font-medium text-gray-900">Subtotal</span>
                                <span class="text-base font-medium text-gray-900">${{ cartStore.subtotal.toFixed(2) }}</span>
                            </div>
                            
                            <div class="flex justify-between mt-2">
                                <span class="text-base font-medium text-gray-900">Shipping</span>
                                <span class="text-base font-medium text-gray-900">$0.00</span>
                            </div>
                            
                            <div class="flex justify-between mt-4 border-t border-gray-200 pt-4">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-gray-900">${{ cartStore.subtotal.toFixed(2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { useCartStore } from '@/stores/cart';
import { useToast } from "vue-toastification";

const toast = useToast(); 
const router = useRouter();
const cartStore = useCartStore();

const form = ref({
    full_name: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
    zip_code: '',
    card_number: '',
    expiry_date: '',
    cvv: '',
    simulate_result: '1', // Default to approved
});

const errors = ref({
    email: '',
    phone: '',
    card_number: '',
    expiry_date: '',
    cvv: '',
});

const isSubmitting = ref(false);

onMounted(() => { 
    // Check if there are items in the cart
    if (!cartStore.cart || cartStore.cart.length === 0) {
        router.push({ name: 'landing' });
        return;
    }
    
    // Since backend only handles one product, warn if multiple items
    if (cartStore.cart.length > 1) {
        cartStore.cart = [cartStore.cart[0]];
    }
});

const validateEmail = () => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(form.value.email)) {
        errors.value.email = 'Please enter a valid email address';
        return false;
    }
    errors.value.email = '';
    return true;
};

const validatePhone = () => {
    const phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    if (!phoneRegex.test(form.value.phone)) {
        errors.value.phone = 'Please enter a valid phone number';
        return false;
    }
    errors.value.phone = '';
    return true;
};

const validateCardNumber = () => {
    const cardNumber = form.value.card_number.replace(/\s+/g, '');
    if (cardNumber.length !== 16 || !/^\d+$/.test(cardNumber)) {
        errors.value.card_number = 'Card number must be 16 digits';
        return false;
    }
    errors.value.card_number = '';
    return true;
};

const validateExpiryDate = () => {
    if (!form.value.expiry_date) {
        errors.value.expiry_date = 'Please select an expiry date';
        return false;
    }
    
    const today = new Date();
    const [year, month] = form.value.expiry_date.split('-');
    const expiryDate = new Date(parseInt(year), parseInt(month) - 1, 1);
    
    if (expiryDate < today) {
        errors.value.expiry_date = 'Expiry date must be in the future';
        return false;
    }
    
    errors.value.expiry_date = '';
    return true;
};

const validateCvv = () => {
    if (form.value.cvv.length !== 3 || !/^\d+$/.test(form.value.cvv)) {
        errors.value.cvv = 'CVV must be 3 digits';
        return false;
    }
    errors.value.cvv = '';
    return true;
};

const submitOrder = async () => {
    // Validate all fields
    const isEmailValid = validateEmail();
    const isPhoneValid = validatePhone();
    const isCardNumberValid = validateCardNumber();
    const isExpiryDateValid = validateExpiryDate();
    const isCvvValid = validateCvv();
    
    if (!isEmailValid || !isPhoneValid || !isCardNumberValid || !isExpiryDateValid || !isCvvValid) {
        return;
    }
    
    // Since backend only handles one product, get the first cart item
    const firstCartItem = cartStore.cart[0];
    
    isSubmitting.value = true;
    
    try {
        const payload = {
            ...form.value,
            product_id: firstCartItem.product.id,
            quantity: firstCartItem.quantity,
            variant_options: firstCartItem.variantOptions
        };
        
        const response = await axios.post('/api/checkout', payload);
        
        if (response.data.success) {
            // Clear the cart after successful order
            cartStore.clearCart();
            router.push({
                name: 'thank-you',
                params: { orderNumber: response.data.order_number },
            });
        }
    } catch (error) {
        console.error('Error submitting order:', error);
        if (error.response) {
            toast.error(error.response?.data?.message || 'An error occurred while processing your order.');
        } 
    } finally {
        isSubmitting.value = false;
    }
};
</script>