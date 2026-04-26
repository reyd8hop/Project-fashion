<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import StorefrontNavbar from '@/components/StorefrontNavbar.vue';

type Order = {
    id: number;
    total_price: number;
    status: string;
    created_at: string;
    items: Array<{ id: number; quantity: number; price: number; product?: { name: string } }>;
};

defineProps<{
    orders: Order[];
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);
</script>

<template>
    <Head title="Order History" />
    <StorefrontNavbar />

    <main class="bg-slate-50 text-slate-950">
        <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="mb-10 rounded-4xl bg-slate-200 p-8 shadow-sm ring-1 ring-[#0b3f70]">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Order history</p>
                <h1 class="mt-3 text-4xl font-semibold text-slate-950">Your purchases in one place</h1>
                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
                    Review your order status, purchased items, and total payments from the latest orders.
                </p>
            </div>

            <div class="space-y-6">
                <article v-for="order in orders" :key="order.id" class="overflow-hidden rounded-4xl border border-slate-200 bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-slate-950">Order #{{ order.id }}</h2>
                            <p class="mt-1 text-sm text-slate-500">{{ order.created_at }}</p>
                        </div>
                        <span class="rounded-full bg-[#0b3f70] px-3 py-1 text-sm font-semibold text-white">{{ order.status }}</span>
                    </div>
                    <div class="mt-5 grid gap-4 rounded-3xl bg-[#0b3f70] p-5 text-sm text-slate-200">
                        <div v-for="item in order.items" :key="item.id" class="flex items-center justify-between">
                            <span>{{ item.product?.name || 'Product' }} x {{ item.quantity }}</span>
                            <span>{{ formatPrice(item.price * item.quantity) }}</span>
                        </div>
                    </div>
                    <div class="mt-5 flex items-center justify-between border-t border-slate-200 pt-4 text-base font-semibold text-slate-950">
                        <span>Total paid</span>
                        <span>{{ formatPrice(order.total_price) }}</span>
                    </div>
                </article>
            </div>

            <div v-if="!orders.length" class="rounded-3xl border border-dashed border-[#0b3f70] bg-slate-200 p-10 text-center text-slate-500">
                Belum ada order.
            </div>
        </section>
    </main>
</template>
