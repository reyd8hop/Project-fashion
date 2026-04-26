<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';

type Order = {
    id: number;
    total_price: number;
    status: string;
    created_at: string;
    user?: { name: string; email: string };
    items: Array<{ id: number; quantity: number; product?: { name: string } }>;
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

const updateStatus = (order: Order, status: string) => {
    router.patch(`/admin/orders/${order.id}/status`, { status });
};
</script>

<template>
    <Head title="Order List" />

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 text-slate-950 px-4 py-6 sm:px-6 lg:px-8">
        <section class="rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Orders</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-950">Order list</h1>
                    <p class="mt-2 text-sm text-slate-500">Pantau order pelanggan dan status pembayaran.</p>
                </div>
                <div class="relative w-full min-w-55 sm:w-70">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <Search class="h-4 w-4" />
                    </span>
                    <input
                        type="search"
                        placeholder="Search orders"
                        class="w-full rounded-full border border-slate-300 bg-slate-100 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                    />
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-slate-200">
                <table class="min-w-full divide-y divide-slate-200 bg-slate-200 text-sm text-slate-800">
                    <thead class="bg-slate-300 text-left text-xs uppercase tracking-[0.2em] text-slate-500">
                        <tr>
                            <th class="px-4 py-4">Order</th>
                            <th class="px-4 py-4">Customer</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4">Amount</th>
                            <th class="px-4 py-4">Created</th>
                            <th class="px-4 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr v-for="order in orders" :key="order.id" class="transition hover:bg-slate-300">
                            <td class="px-4 py-4 font-semibold text-slate-950">#{{ order.id }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ order.user?.name || 'Customer' }}</td>
                            <td class="px-4 py-4">
                                <span
                                    :class="[
                                        'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                        order.status === 'pending'
                                            ? 'bg-amber-100 text-amber-700'
                                            : 'bg-emerald-100 text-emerald-700',
                                    ]"
                                >
                                    {{ order.status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 font-semibold text-slate-950">{{ formatPrice(order.total_price) }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ order.created_at }}</td>
                            <td class="px-4 py-4 text-right">
                                <select
                                    class="h-10 rounded-full border border-slate-300 bg-slate-200 px-3 text-sm text-slate-700 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                                    :value="order.status"
                                    @change="updateStatus(order, ($event.target as HTMLSelectElement).value)"
                                >
                                    <option value="pending">pending</option>
                                    <option value="selesai">selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr v-if="!orders.length">
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">Belum ada order.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>
