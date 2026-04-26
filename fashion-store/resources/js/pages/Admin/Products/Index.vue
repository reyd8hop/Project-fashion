<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';

type Product = {
    id: number;
    name: string;
    description?: string;
    price: number;
    stock: number;
    image?: string | null;
};

defineProps<{
    products: Product[];
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);

const deleteProduct = (product: Product) => {
    if (confirm(`Delete ${product.name}?`)) {
        router.delete(`/admin/products/${product.id}`);
    }
};
</script>

<template>
    <Head title="Product Management" />

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 text-slate-950 px-4 py-6 sm:px-6 lg:px-8">
        <section class="rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Products</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-950">Product management</h1>
                    <p class="mt-2 text-sm text-slate-500">Kelola daftar produk, harga, dan stok.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div class="relative w-full min-w-55 sm:w-70">
                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <Search class="h-4 w-4" />
                        </span>
                        <input
                            placeholder="Search product"
                            class="w-full rounded-full border border-slate-300 bg-slate-100 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                            type="search"
                        />
                    </div>
                    <Link
                        href="/admin/products/create"
                        class="inline-flex items-center justify-center rounded-full bg-[#0b3f70] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0d4b8e]"
                    >
                        Create product
                    </Link>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-slate-200">
                <table class="min-w-full divide-y divide-slate-200 bg-slate-200 text-sm text-slate-800">
                    <thead class="bg-slate-300 text-left text-xs uppercase tracking-[0.2em] text-slate-500">
                        <tr>
                            <th class="px-4 py-4">Product</th>
                            <th class="px-4 py-4">Price</th>
                            <th class="px-4 py-4">Stock</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr v-for="product in products" :key="product.id" class="transition hover:bg-slate-300">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 overflow-hidden rounded-3xl bg-[#0b3f70]">
                                        <img v-if="product.image" :src="product.image" :alt="product.name" class="h-full w-full object-cover" />
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-950">{{ product.name }}</p>
                                        <p class="text-sm text-slate-500">{{ product.description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-slate-700">{{ formatPrice(product.price) }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ product.stock }}</td>
                            <td class="px-4 py-4">
                                <span
                                    :class="[
                                        'inline-flex rounded-full px-3 py-1 text-sm font-semibold',
                                        product.stock > 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700',
                                    ]"
                                >
                                    {{ product.stock > 0 ? 'Published' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <div class="flex flex-wrap items-center justify-end gap-2">
                                    <Link
                                        :href="`/admin/products/${product.id}`"
                                        class="rounded-full border border-slate-200 bg-[#0b3f70] px-3 py-2 text-xs font-medium text-white transition hover:bg-[#0d4b8e]"
                                    >
                                        Show
                                    </Link>
                                    <Link
                                        :href="`/admin/products/${product.id}/edit`"
                                        class="rounded-full border border-slate-200 bg-[#0b3f70] px-3 py-2 text-xs font-medium text-white transition hover:bg-[#0d4b8e]"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteProduct(product)"
                                        class="rounded-full border border-slate-200 bg-[#0b3f70] px-3 py-2 text-xs font-semibold text-white transition hover:bg-[#0d4b8e]"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!products.length">
                            <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">Belum ada produk.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>
