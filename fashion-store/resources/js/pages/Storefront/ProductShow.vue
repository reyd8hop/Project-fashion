<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ShoppingCart } from 'lucide-vue-next';
import StorefrontNavbar from '@/components/StorefrontNavbar.vue';

type Product = {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    image?: string | null;
};

const props = defineProps<{
    product: Product;
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);

const addToCart = () => {
    router.post(`/cart/${props.product.id}`);
};
</script>

<template>
    <Head :title="product.name" />
    <StorefrontNavbar />

    <main class="bg-slate-50 text-slate-950">
        <section class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_0.9fr] lg:py-16">
            <div class="space-y-6 rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70] sm:p-8">
                <img
                    v-if="product.image"
                    :src="product.image"
                    :alt="product.name"
                    class="aspect-4/5 w-full rounded-[1.75rem] object-cover"
                />
                <div v-else class="flex aspect-4/5 items-center justify-center rounded-[1.75rem] bg-slate-300 text-slate-500">
                    No image
                </div>
            </div>

            <section class="space-y-8 rounded-4xl bg-slate-200 p-8 shadow-sm ring-1 ring-[#0b3f70]">
                <div class="space-y-2">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Product details</p>
                    <h1 class="text-4xl font-semibold text-slate-950">{{ product.name }}</h1>
                    <p class="text-3xl font-semibold text-slate-950">{{ formatPrice(product.price) }}</p>
                </div>

                <div class="space-y-4 text-slate-700">
                    <p>{{ product.description }}</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-3xl bg-[#0b3f70] p-5">
                            <p class="text-sm text-slate-200">Stock</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ product.stock }}</p>
                        </div>
                        <div class="rounded-3xl bg-[#0b3f70] p-5">
                            <p class="text-sm text-slate-200">Status</p>
                            <p class="mt-1 text-lg font-semibold text-white">{{ product.stock > 0 ? 'Available' : 'Out of stock' }}</p>
                        </div>
                    </div>
                </div>

                <button
                    type="button"
                    class="inline-flex h-12 items-center justify-center rounded-full bg-slate-200 px-6 text-sm font-semibold text-slate-950 transition hover:bg-slate-300 disabled:cursor-not-allowed disabled:bg-slate-700 disabled:text-slate-400"
                    :disabled="product.stock < 1"
                    @click="addToCart"
                >
                    <ShoppingCart class="size-4" />
                    <span class="ml-2">Add to cart</span>
                </button>
            </section>
        </section>
    </main>
</template>
