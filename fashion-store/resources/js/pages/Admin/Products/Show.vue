<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Product = {
    id: number;
    name: string;
    description: string;
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
</script>

<template>
    <Head :title="product.name" />

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 text-slate-950 px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Product detail</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-950">{{ product.name }}</h1>
                </div>
                <Link href="/admin/products" class="rounded-full border border-slate-200 bg-[#0b3f70] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0d4b8e]">
                    Back to products
                </Link>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-[340px_1fr]">
                <div class="overflow-hidden rounded-[1.75rem] bg-slate-300">
                    <img v-if="product.image" :src="product.image" :alt="product.name" class="aspect-square w-full object-cover" />
                    <div v-else class="flex aspect-square items-center justify-center text-sm text-slate-500">No image available</div>
                </div>

                <section class="space-y-6 rounded-[1.75rem] border border-slate-200 bg-slate-200 p-6">
                    <p class="text-sm text-slate-700">{{ product.description }}</p>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl bg-[#0b3f70] p-5">
                            <p class="text-sm text-slate-200">Price</p>
                            <p class="mt-3 text-2xl font-semibold text-white">{{ formatPrice(product.price) }}</p>
                        </div>
                        <div class="rounded-3xl bg-[#0b3f70] p-5">
                            <p class="text-sm text-slate-200">Stock</p>
                            <p class="mt-3 text-2xl font-semibold text-white">{{ product.stock }}</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
