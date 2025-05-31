<template>
    <div v-if="loading" class="text-center py-12">
        <svg class="animate-spin h-8 w-8 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="mt-2 text-gray-600">Loading product...</p>
    </div>

    <!-- Add error state -->
    <div v-else-if="error" class="text-center py-12">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <h3 class="mt-2 text-lg font-medium text-gray-900">Failed to load product</h3>
        <p class="mt-1 text-sm text-gray-500">{{ error }}</p>
        <button @click="fetchProduct" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Retry
        </button>
    </div>
    <div v-else class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <!-- Product Image -->
            <div class="mb-8 lg:mb-0">
                <img :src="product.image_url" :alt="product.name" class="w-full rounded-lg shadow-lg">
            </div>
            
            <!-- Product Info -->
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ product.name }}</h1>
                <p class="text-xl text-gray-600 mb-6">${{ product.price }}</p>
                
                <p class="text-gray-700 mb-8">{{ product.description }}</p>
                
                <!-- Variant Selectors -->
                <div v-for="variant in product.variants" :key="variant.id" class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">{{ variant.name }}</h3>
                    <div class="flex flex-wrap gap-2">
                        <button
                            v-for="option in variant.options"
                            :key="option.id"
                            @click="selectVariant(variant.id, option.id)"
                            class="px-4 py-2 border rounded-md text-sm font-medium"
                            :class="{
                                'bg-indigo-600 text-white border-indigo-600': isVariantSelected(variant.id, option.id),
                                'bg-white text-gray-700 border-gray-300 hover:bg-gray-50': !isVariantSelected(variant.id, option.id),
                            }"
                        >
                            {{ option.value }}
                        </button>
                    </div>
                </div>
                
                <!-- Quantity Selector -->
                <div class="mb-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Quantity</h3>
                    <div class="flex items-center">
                        <button 
                            @click="decrementQuantity"
                            class="px-3 py-1 border border-gray-300 rounded-l-md bg-gray-50 text-gray-700 hover:bg-gray-100"
                            :disabled="quantity <= 1"
                        >
                            -
                        </button>
                        <span class="px-4 py-1 border-t border-b border-gray-300 bg-white text-gray-900">
                            {{ quantity }}
                        </span>
                        <button 
                            @click="incrementQuantity"
                            class="px-3 py-1 border border-gray-300 rounded-r-md bg-gray-50 text-gray-700 hover:bg-gray-100"
                        >
                            +
                        </button>
                    </div>
                </div>
                
                <!-- Buy Now Button -->
                <button
                    @click="proceedToCheckout"
                    class="w-full bg-indigo-600 py-3 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Buy Now
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { useCartStore } from '@/stores/cart';


const router = useRouter();
const cartStore = useCartStore();


const product = ref({
    id: null,
    name: '',
    description: '',
    price: 0,
    image_url: '',
    variants: [],
});

const selectedVariants = ref({});
const quantity = ref(1);

const loading = ref(true);
const error = ref(null);

const fetchProduct = async () => {
    try {
        loading.value = true;
        error.value = null;
        const response = await axios.get('/api/products/1');
        product.value = response.data;
        
        product.value.variants.forEach(variant => {
            if (variant.options.length > 0) {
                selectedVariants.value[variant.id] = variant.options[0].id;
            }
        });
    } catch (err) {
        error.value = err.response?.data?.message || 'Failed to load product';
        console.error('Error fetching product:', err);
    } finally {
        loading.value = false;
    }
};

onMounted(fetchProduct);

const selectVariant = (variantId, optionId) => {
    selectedVariants.value[variantId] = optionId;
};

const isVariantSelected = (variantId, optionId) => {
    return selectedVariants.value[variantId] === optionId;
};

const incrementQuantity = () => {
    quantity.value += 1;
};

const decrementQuantity = () => {
    if (quantity.value > 1) {
        quantity.value -= 1;
    }
};

const proceedToCheckout = () => {
    // Prepare selected variant options data

    cartStore.clearCart();
    const variantOptions = {};
    product.value.variants.forEach(variant => {
        const selectedOptionId = selectedVariants.value[variant.id];
        const selectedOption = variant.options.find(opt => opt.id === selectedOptionId);
        if (selectedOption) {
            variantOptions[variant.name] = selectedOption.value;
        }
    });
    
    cartStore.addToCart(product.value, quantity.value, variantOptions);
    router.push({ name: 'checkout' });

};
</script>