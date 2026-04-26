<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

type Product = {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    image?: string | null;
};

const props = defineProps<{
    product: Product | null;
}>();

const form = useForm({
    name: props.product?.name ?? '',
    description: props.product?.description ?? '',
    price: props.product?.price ?? 0,
    stock: props.product?.stock ?? 0,
    image: props.product?.image ?? '',
});

const submit = () => {
    if (props.product) {
        form.put(`/admin/products/${props.product.id}`);

        return;
    }

    form.post('/admin/products');
};
</script>

<template>
    <Head :title="product ? 'Edit Product' : 'Create Product'" />

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 text-slate-950 px-4 py-6 sm:px-6 lg:px-8">
        <section class="mx-auto max-w-4xl rounded-4xl bg-slate-200 p-6 shadow-sm ring-1 ring-[#0b3f70]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Product form</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-950">{{ product ? 'Edit product' : 'Create product' }}</h1>
                    <p class="mt-2 text-sm text-slate-500">Isi data produk yang akan ditampilkan di storefront.</p>
                </div>
                <Link href="/admin/products" class="rounded-full border border-slate-200 bg-[#0b3f70] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#0d4b8e]">
                    Back to products
                </Link>
            </div>

            <form class="mt-8 space-y-6" @submit.prevent="submit">
                <div class="grid gap-6 rounded-3xl border border-slate-200 bg-slate-200 p-6">
                    <div>
                        <label class="text-sm font-medium text-slate-700" for="name">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            class="mt-3 h-12 w-full rounded-3xl border border-slate-300 bg-slate-300 px-4 text-sm text-slate-900 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                            type="text"
                        />
                        <p v-if="form.errors.name" class="mt-2 text-sm text-rose-500">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-slate-700" for="description">Description</label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            class="mt-3 min-h-40 w-full rounded-3xl border border-slate-300 bg-slate-300 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                        />
                        <p v-if="form.errors.description" class="mt-2 text-sm text-rose-500">{{ form.errors.description }}</p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-slate-700" for="price">Price</label>
                            <input
                                id="price"
                                v-model="form.price"
                            class="mt-3 h-12 w-full rounded-3xl border border-slate-300 bg-slate-300 px-4 text-sm text-slate-900 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                            min="0"
                            type="number"
                        />
                        <p v-if="form.errors.price" class="mt-2 text-sm text-rose-500">{{ form.errors.price }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-slate-700" for="stock">Stock</label>
                            <input
                                id="stock"
                                v-model="form.stock"
                                class="mt-3 h-12 w-full rounded-3xl border border-slate-300 bg-slate-300 px-4 text-sm text-slate-900 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                                min="0"
                                type="number"
                            />
                            <p v-if="form.errors.stock" class="mt-2 text-sm text-rose-500">{{ form.errors.stock }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-slate-700" for="image">Image URL</label>
                        <input
                            id="image"
                            v-model="form.image"
                            class="mt-3 h-12 w-full rounded-3xl border border-slate-300 bg-slate-300 px-4 text-sm text-slate-900 outline-none transition focus:border-[#0b3f70] focus:ring-2 focus:ring-[#0b3f70]"
                            type="url"
                        />
                        <p v-if="form.errors.image" class="mt-2 text-sm text-rose-500">{{ form.errors.image }}</p>
                    </div>
                </div>

                <button
                    class="inline-flex h-12 items-center justify-center rounded-3xl bg-[#0b3f70] px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0d4b8e] disabled:cursor-not-allowed disabled:opacity-60"
                    :disabled="form.processing"
                    type="submit"
                >
                    {{ product ? 'Update product' : 'Create product' }}
                </button>
            </form>
        </section>
    </div>
</template>
