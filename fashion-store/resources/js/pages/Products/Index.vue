<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Product = {
    id: number;
    name: string;
    description?: string;
    price: number;
    image?: string | null;
    stock?: number;
};

const props = defineProps<{ products: Product[] }>();

const formatPrice = (value: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(value);
</script>

<template>
  <div class="space-y-16 px-4 py-8 sm:px-6 lg:px-8">
    <Head title="Storefront" />

    <section class="relative overflow-hidden rounded-[2rem] bg-white shadow-xl ring-1 ring-zinc-200 dark:bg-zinc-950 dark:ring-zinc-800">
      <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="flex flex-col justify-center px-6 py-10 sm:px-10 lg:px-14">
          <span class="inline-flex rounded-full bg-zinc-900 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white dark:bg-zinc-100 dark:text-zinc-950">
            New Collection
          </span>
          <h1 class="mt-6 text-4xl font-semibold tracking-tight text-zinc-950 dark:text-white sm:text-5xl">
            Our latest offer for modern men.
          </h1>
          <p class="mt-5 max-w-xl text-base leading-8 text-zinc-600 dark:text-zinc-300">
            Discover curated essentials with a clean contemporary look, premium details, and effortless styling for everyday wear.
          </p>
          <div class="mt-8 flex flex-wrap gap-3">
            <a href="#products" class="inline-flex items-center justify-center rounded-full bg-zinc-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-800 dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200">
              Shop now
            </a>
            <button class="inline-flex items-center justify-center rounded-full border border-zinc-300 px-5 py-3 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-900">
              Explore styles
            </button>
          </div>
          <div class="mt-10 grid grid-cols-3 gap-4 sm:grid-cols-6">
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">All</div>
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">T-shirt</div>
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">Jeans</div>
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">Outwear</div>
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">Hoodie</div>
            <div class="rounded-full bg-zinc-100 px-3 py-2 text-center text-xs font-semibold uppercase tracking-[0.24em] text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">Pants</div>
          </div>
        </div>

        <div class="relative overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-br from-zinc-100 via-transparent to-transparent dark:from-zinc-900"></div>
          <div class="relative flex h-full items-center justify-center p-6 sm:p-10">
            <div class="grid w-full gap-4 sm:grid-cols-2">
              <div class="aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-zinc-100 shadow-lg dark:bg-zinc-900">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=900&q=80" alt="Product hero" class="h-full w-full object-cover" />
              </div>
              <div class="grid gap-4">
                <div class="aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-zinc-100 shadow-lg dark:bg-zinc-900">
                  <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80" alt="Product hero" class="h-full w-full object-cover" />
                </div>
                <div class="aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-zinc-100 shadow-lg dark:bg-zinc-900">
                  <img src="https://images.unsplash.com/photo-1514996937319-344454492b37?auto=format&fit=crop&w=900&q=80" alt="Product hero" class="h-full w-full object-cover" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="products" class="space-y-8">
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.32em] text-zinc-500 dark:text-zinc-400">Our product</p>
          <h2 class="mt-3 text-3xl font-semibold tracking-tight text-zinc-950 dark:text-white">Find the best pieces for your wardrobe.</h2>
        </div>
        <div class="flex flex-wrap items-center gap-2">
          <button class="rounded-full border border-zinc-300 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-200 dark:hover:bg-zinc-900">New</button>
          <button class="rounded-full border border-zinc-300 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-200 dark:hover:bg-zinc-900">Popular</button>
          <button class="rounded-full border border-zinc-300 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-200 dark:hover:bg-zinc-900">Sale</button>
        </div>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <article v-for="product in props.products" :key="product.id" class="group overflow-hidden rounded-[2rem] border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-950">
          <div class="relative overflow-hidden bg-zinc-100">
            <img
              :src="product.image || 'https://images.unsplash.com/photo-1521334884684-d80222895322?auto=format&fit=crop&w=900&q=80'"
              :alt="product.name"
              class="h-72 w-full object-cover transition duration-500 group-hover:scale-105"
            />
          </div>
          <div class="space-y-4 p-6">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.3em] text-zinc-500 dark:text-zinc-400">Men's wear</p>
              <h3 class="mt-3 text-xl font-semibold text-zinc-950 dark:text-white">{{ product.name }}</h3>
            </div>
            <p class="text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ product.description || 'High quality design with excellent fit and comfort.' }}</p>
            <div class="flex items-center justify-between gap-4">
              <p class="text-lg font-semibold text-zinc-950 dark:text-white">{{ formatPrice(product.price) }}</p>
              <Link
                :href="`/products/${product.id}`"
                class="rounded-full bg-zinc-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-zinc-800 dark:bg-zinc-50 dark:text-zinc-950 dark:hover:bg-zinc-200"
              >
                View
              </Link>
            </div>
          </div>
        </article>
      </div>
    </section>
  </div>
</template>