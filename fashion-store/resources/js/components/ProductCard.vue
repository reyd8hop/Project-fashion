<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { ShoppingCart } from 'lucide-vue-next';

type Product = {
    id: number;
    name: string;
    description?: string;
    price: number;
    stock: number;
    image?: string | null;
};

defineProps<{
    product: Product;
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);

const addToCart = (productId: number) => {
    router.post(`/cart/${productId}`);
};
</script>

<template>
    <article class="overflow-hidden rounded-lg border border-slate-200 bg-slate-50 text-[#071c3c] shadow-[0_18px_50px_-28px_rgba(15,23,42,0.35)] transition hover:-translate-y-0.5 hover:shadow-[0_28px_65px_-25px_rgba(15,23,42,0.25)]">
        <Link :href="`/products/${product.id}`" class="block">
            <div class="aspect-[4/5] bg-[#0d2755]">
                <img
                    v-if="product.image"
                    :src="product.image"
                    :alt="product.name"
                    class="h-full w-full object-cover"
                />
                <div v-else class="flex h-full items-center justify-center text-sm text-slate-400">
                    No image
                </div>
            </div>
        </Link>

        <div class="space-y-3 p-4">
            <div>
                <Link :href="`/products/${product.id}`" class="font-medium text-[#071c3c] hover:underline">
                    {{ product.name }}
                </Link>
                <p class="mt-1 line-clamp-2 text-sm text-slate-600">
                    {{ product.description || 'Fashion item ready for your daily rotation.' }}
                </p>
            </div>

            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="font-semibold text-[#071c3c]">{{ formatPrice(product.price) }}</p>
                    <p class="text-xs text-slate-500">Stock {{ product.stock }}</p>
                </div>
                <button
                    type="button"
                    class="inline-flex size-10 items-center justify-center rounded-md bg-white text-slate-950 hover:bg-slate-200 disabled:cursor-not-allowed disabled:bg-slate-700 disabled:text-slate-400"
                    :disabled="product.stock < 1"
                    @click="addToCart(product.id)"
                >
                    <ShoppingCart class="size-4" />
                </button>
            </div>
        </div>
    </article>
</template>
