<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Stats = {
    products: number;
    orders: number;
    customers: number;
    revenue: number;
};

type Order = {
    id: number;
    status: string;
    total_price: number;
    user?: { name: string };
};

defineProps<{
    stats: Stats;
    recentOrders: Order[];
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);
</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">
        <section class="rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Overview</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-950">Dashboard</h1>
                    <p class="mt-2 text-sm text-slate-500">Ringkasan toko dan aktivitas order terbaru.</p>
                </div>

                <Link
                    href="/admin/products"
                    class="inline-flex items-center justify-center rounded-full bg-[#0b3f70] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0d4b8e]"
                >
                    Manage products
                </Link>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-3xl bg-slate-200 p-5 shadow-sm border border-[#0b3f70]/10">
                    <p class="text-sm text-slate-500">Products</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-950">{{ stats.products }}</p>
                </div>
                <div class="rounded-3xl bg-gray-50 p-5 shadow-sm border border-[#0b3f70]/10">
                    <p class="text-sm text-slate-500">Orders</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-950">{{ stats.orders }}</p>
                </div>
                <div class="rounded-3xl bg-slate-200 p-5 shadow-sm border border-[#0b3f70]/10">
                    <p class="text-sm text-slate-500">Customers</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-950">{{ stats.customers }}</p>
                </div>
                <div class="rounded-3xl bg-slate-200 p-5 shadow-sm border border-[#0b3f70]/10">
                    <p class="text-sm text-slate-500">Revenue</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-950">{{ formatPrice(stats.revenue) }}</p>
                </div>
            </div>
        </section>

        <section class="mt-6 rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-slate-950">Recent orders</h2>
                    <p class="mt-1 text-sm text-slate-500">Order terbaru masuk.</p>
                </div>
                <Link href="/admin/orders" class="text-sm font-semibold text-[#0b3f70] transition hover:text-[#0d4b8e]">
                    View all
                </Link>
            </div>

            <div class="mt-5 space-y-4">
                <div
                    v-for="order in recentOrders"
                    :key="order.id"
                    class="rounded-3xl border border-[#0b3f70]/10 bg-slate-200 p-5 shadow-sm"
                >
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Order #{{ order.id }}</p>
                            <p class="mt-2 text-lg font-semibold text-slate-950">{{ order.user?.name || 'Customer' }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="rounded-full bg-[#0b3f70] px-3 py-1 text-sm font-medium text-white">
                                {{ order.status }}
                            </span>
                            <p class="text-sm font-semibold text-slate-950">{{ formatPrice(order.total_price) }}</p>
                        </div>
                    </div>
                </div>
                <p v-if="!recentOrders.length" class="rounded-3xl border border-[#0b3f70]/10 bg-slate-200 p-5 text-sm text-slate-500">
                    Belum ada order.
                </p>
            </div>
        </section>
    </div>
</template>
