<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import CartItem from '@/components/CartItem.vue';
import ProductCard from '@/components/ProductCard.vue';
import StorefrontNavbar from '@/components/StorefrontNavbar.vue';

type Item = {
    id: number;
    name: string;
    price: number;
    image?: string | null;
    quantity: number;
};

type Product = {
    id: number;
    name: string;
    description?: string;
    price: number;
    stock: number;
    image?: string | null;
};

const props = defineProps<{
    items: Item[];
    recommendedProducts: Product[];
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);

const subtotal = () => props.items.reduce((total, item) => total + item.price * item.quantity, 0);

const page = usePage();

const checkout = () => {
    if (!page.props.auth.user) {
        router.visit('/login');

        return;
    }

    router.post('/checkout');
};
</script>

<template>
    <Head title="Cart" />
    <StorefrontNavbar />

    <main class="min-h-screen bg-slate-50 text-slate-950">
        <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1.4fr_0.9fr]">
                <div class="space-y-6 rounded-4xl bg-slate-200 p-8 shadow-sm ring-1 ring-[#0b3f70]">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Shopping cart</p>
                            <h1 class="mt-2 text-4xl font-semibold text-slate-950">Your selected items</h1>
                        </div>
                        <p class="text-sm text-slate-500">{{ items.length }} item(s) in cart</p>
                    </div>

                    <div v-if="items.length" class="space-y-4">
                        <CartItem v-for="item in items" :key="item.id" :item="item" />
                    </div>
                    <div v-else class="rounded-3xl border border-[#0b3f70] bg-slate-200 p-10 text-center text-slate-700">
                        <p class="text-lg font-semibold text-slate-950">Cart masih kosong.</p>
                        <p class="mt-2">Tambahkan produk ke keranjang agar dapat checkout.</p>
                        <Link href="/" class="mt-6 inline-flex rounded-full bg-[#0b3f70] px-6 py-3 text-sm font-semibold text-white hover:bg-[#0d4b8e]">
                            Belanja sekarang
                        </Link>
                    </div>
                </div>

                <aside class="space-y-6 rounded-4xl bg-slate-200 p-8 shadow-sm ring-1 ring-[#0b3f70]">
                    <div class="space-y-3">
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Order summary</p>
                        <h2 class="text-2xl font-semibold text-slate-950">Total pembayaran</h2>
                    </div>
                    <div class="space-y-3 rounded-3xl bg-[#0b3f70] p-5">
                        <div class="flex justify-between text-sm text-slate-200">
                            <span>Subtotal</span>
                            <span>{{ formatPrice(subtotal()) }}</span>
                        </div>
                        <div class="flex justify-between border-t border-slate-700 pt-3 text-base font-semibold text-white">
                            <span>Total</span>
                            <span>{{ formatPrice(subtotal()) }}</span>
                        </div>
                    </div>
                    <button
                        class="w-full rounded-full bg-[#0b3f70] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#0d4b8e] disabled:cursor-not-allowed disabled:bg-slate-400 disabled:text-slate-700"
                        :disabled="!items.length"
                        @click="checkout"
                    >
                        Checkout
                    </button>
                </aside>
            </div>

            <div v-if="recommendedProducts.length" class="mt-10 rounded-4xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Recommended</p>
                        <h2 class="mt-2 text-3xl font-semibold text-slate-950">Lengkapi gaya Anda</h2>
                    </div>
                    <Link href="/" class="text-sm font-semibold text-[#0b3f70] hover:text-[#0d4b8e]">
                        Lihat semua produk
                    </Link>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <ProductCard v-for="product in recommendedProducts" :key="product.id" :product="product" />
                </div>
            </div>
        </section>
    </main>
</template>
