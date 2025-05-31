import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useCartStore = defineStore('cart', () => {
    const cart = ref([]);
    
    const addToCart = (product, quantity, variantOptions) => {
        const existingItemIndex = cart.value.findIndex(
            item => item.product.id === product.id && 
                   JSON.stringify(item.variantOptions) === JSON.stringify(variantOptions)
        );
        
        if (existingItemIndex >= 0) {
            cart.value[existingItemIndex].quantity += quantity;
        } else {
            cart.value.push({
                product,
                quantity,
                variantOptions
            });
        }
    };
    
    const removeFromCart = (index) => {
        cart.value.splice(index, 1);
    };
    
    const clearCart = () => {
        cart.value = [];
    };
    
    const totalItems = computed(() => {
        return cart.value.reduce((total, item) => total + item.quantity, 0);
    });
    
    const subtotal = computed(() => {
        return cart.value.reduce((total, item) => total + (item.product.price * item.quantity), 0);
    });
    
    return {
        cart,
        addToCart,
        removeFromCart,
        clearCart,
        totalItems,
        subtotal
    };
});