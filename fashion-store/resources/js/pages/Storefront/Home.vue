<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import image1 from '@/assets/1.jpg';
import image10 from '@/assets/10.jpg';
import image2 from '@/assets/2.jpg';

// Import local images
import image3 from '@/assets/3.jpg';
import image4 from '@/assets/4.jpg';
import image5 from '@/assets/5.jpg';
import image6 from '@/assets/6.jpg';
import image7 from '@/assets/7.jpg';
import image8 from '@/assets/8.jpg';
import image9 from '@/assets/9.jpg';
import ProductCard from '@/components/ProductCard.vue';
import StorefrontNavbar from '@/components/StorefrontNavbar.vue';

type Product = {
    id: number;
    name: string;
    description?: string;
    price: number;
    stock: number;
    image?: string | null;
};

const props = defineProps<{
    products: Product[];
}>();

const sampleProducts: Product[] = [
    {
        id: 1,
        name: 'Classic White Tee',
        description: 'Kaos putih klasik dengan bahan katun lembut dan potongan modern yang bersih. Cocok untuk gaya sehari-hari yang simpel dan elegan.',
        price: 149000,
        stock: 24,
        image: image1,
    },
    {
        id: 2,
        name: 'Navy Stripe Shirt',
        description: 'Kemeja bergaris navy yang sempurna untuk layering sehari-hari. Terbuat dari bahan berkualitas tinggi dengan desain klasik.',
        price: 199000,
        stock: 18,
        image: image2,
    },
    {
        id: 3,
        name: 'Black Graphic Tee',
        description: 'Kaos grafis hitam dengan cetakan bold yang cocok untuk gaya streetwear. Terbuat dari bahan katun yang nyaman dipakai.',
        price: 169000,
        stock: 12,
        image: image3,
    },
    {
        id: 4,
        name: 'Slim Fit Jeans',
        description: 'Celana jeans slim fit dengan bahan denim stretch yang nyaman. Potongan ramping yang cocok untuk berbagai acara.',
        price: 299000,
        stock: 16,
        image: image4,
    },
    {
        id: 5,
        name: 'Relaxed Denim Pants',
        description: 'Celana denim relaxed fit dengan wash vintage yang stylish. Nyaman untuk aktivitas sehari-hari dengan gaya kasual.',
        price: 329000,
        stock: 10,
        image: image5,
    },
    {
        id: 6,
        name: 'Charcoal Cargo Jeans',
        description: 'Celana cargo jeans charcoal dengan kantong utility yang fungsional. Desain praktis untuk gaya urban modern.',
        price: 349000,
        stock: 8,
        image: image6,
    },
    {
        id: 7,
        name: 'White Leather Sneakers',
        description: 'Sepatu sneakers kulit putih minimalis dengan kualitas premium. Cocok untuk gaya kasual yang elegan.',
        price: 499000,
        stock: 14,
        image: image7,
    },
    {
        id: 8,
        name: 'Retro Running Shoes',
        description: 'Sepatu lari bergaya retro dengan bantalan empuk yang nyaman. Desain klasik dengan teknologi modern.',
        price: 459000,
        stock: 9,
        image: image8,
    },
    {
        id: 9,
        name: 'Aviator Sunglasses',
        description: 'Kacamata hitam aviator dengan frame logam yang dipoles. Lensa tinted untuk perlindungan mata yang optimal.',
        price: 219000,
        stock: 20,
        image: image9,
    },
    {
        id: 10,
        name: 'Lightweight Bomber Jacket',
        description: 'Jaket bomber ringan yang serbaguna untuk malam yang sejuk. Desain modern dengan bahan berkualitas tinggi.',
        price: 399000,
        stock: 6,
        image: image10,
    },
];

const displayProducts = computed(() => {
    const sourceProducts = props.products.length > 0 ? props.products.slice(0, 10) : sampleProducts;

    const mappedProducts = sourceProducts.map((product, index) => ({
        ...product,
        image: sampleProducts[index]?.image ?? product.image ?? null,
    }));

    if (mappedProducts.length >= 10) {
        return mappedProducts.slice(0, 10);
    }

    return [
        ...mappedProducts,
        ...sampleProducts.slice(mappedProducts.length, 10),
    ];
});
</script>

<template>
    <Head title="Home" />
    <StorefrontNavbar />

    <main class="bg-slate-100 text-slate-950">
        <section class="relative overflow-hidden bg-[#071c3c] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.2fr_0.8fr] lg:py-20">
                <div class="flex flex-col justify-center gap-8">
                    <div class="inline-flex items-center gap-3 rounded-full bg-slate-200/95 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-slate-950 shadow-sm shadow-slate-950/10">
                        <span>Velora Collection</span>
                    </div>
                    <div class="max-w-2xl space-y-6">
                        <h1 class="text-5xl font-semibold tracking-tight text-white sm:text-6xl">
                            Temukan koleksi terbaru dengan gaya modern.
                        </h1>
                        <p class="text-lg leading-8 text-slate-300">
                            Jelajahi pilihan pakaian kontemporer dengan detail premium dan kenyamanan effortless untuk tampilan sehari-hari.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="#products" class="inline-flex items-center justify-center rounded-full bg-slate-200 px-6 py-3 text-sm font-semibold text-[#071c3c] transition hover:bg-slate-300 shadow-sm shadow-slate-950/10">
                            Shop now
                        </a>
                        <button class="inline-flex items-center justify-center rounded-full border border-[#0b3f70] bg-[#0b3f70] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#0d4b8e] shadow-sm shadow-slate-950/10">
                            Explore styles
                        </button>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="aspect-4/5 overflow-hidden rounded-4xl bg-[#0d2755] shadow-xl">
                        <img :src="image7" alt="Fashion outfit" class="h-full w-full object-cover" />
                    </div>
                    <div class="space-y-4">
                        <div class="aspect-4/5 overflow-hidden rounded-4xl bg-[#0b3f70] shadow-xl">
                            <img :src="image8" alt="Street style outfit" class="h-full w-full object-cover" />
                        </div>
                        <div class="aspect-4/5 overflow-hidden rounded-4xl bg-[#0b3f70] shadow-xl">
                            <img :src="image9" alt="Modern fashion look" class="h-full w-full object-cover" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="products" class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8 mt-12 relative z-10">
            <div class="rounded-4xl border border-slate-200 bg-white p-8 shadow-[0_-20px_40px_rgba(0,0,0,0.15),0_35px_80px_-45px_rgba(15,23,45,0.2)]">
                <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.32em] text-slate-500">Our product</p>
                        <h2 class="mt-3 text-4xl font-semibold tracking-tight text-slate-950">Perfect match for every look.</h2>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button class="rounded-full border border-slate-300 bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-300 shadow-sm shadow-slate-950/10">All</button>
                        <button class="rounded-full border border-slate-300 bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-300 shadow-sm shadow-slate-950/10">T-shirt</button>
                        <button class="rounded-full border border-slate-300 bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-300 shadow-sm shadow-slate-950/10">Jeans</button>
                        <button class="rounded-full border border-slate-300 bg-slate-200 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-300 shadow-sm shadow-slate-950/10">Hoodie</button>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <ProductCard v-for="product in displayProducts" :key="product.id" :product="product" />
                </div>
            </div>
        </section>
    </main>
</template>
