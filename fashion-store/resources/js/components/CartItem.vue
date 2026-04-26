<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Minus, Plus, Trash2 } from 'lucide-vue-next';

type Item = {
    id: number;
    name: string;
    price: number;
    image?: string | null;
    quantity: number;
};

const props = defineProps<{
    item: Item;
}>();

const formatPrice = (price: number) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(price);

const updateQuantity = (quantity: number) => {
    router.patch(`/cart/${props.item.id}`, { quantity });
};

const removeItem = () => {
    router.delete(`/cart/${props.item.id}`);
};
</script>

<template>
    <div class="grid gap-4 border-b border-slate-800 py-5 sm:grid-cols-[96px_1fr_auto]">
        <div class="aspect-square overflow-hidden rounded-md bg-slate-800">
            <img v-if="item.image" :src="item.image" :alt="item.name" class="h-full w-full object-cover" />
        </div>

        <div class="space-y-2">
            <h3 class="font-medium text-white">{{ item.name }}</h3>
            <p class="text-sm text-slate-400">{{ formatPrice(item.price) }}</p>
            <div class="inline-flex items-center rounded-md border border-slate-700">
                <button
                    type="button"
                    class="inline-flex size-9 items-center justify-center text-white disabled:text-slate-500"
                    :disabled="item.quantity <= 1"
                    @click="updateQuantity(item.quantity - 1)"
                >
                    <Minus class="size-4" />
                </button>
                <span class="w-10 text-center text-sm">{{ item.quantity }}</span>
                <button
                    type="button"
                    class="inline-flex size-9 items-center justify-center text-white"
                    @click="updateQuantity(item.quantity + 1)"
                >
                    <Plus class="size-4" />
                </button>
            </div>
        </div>

        <div class="flex items-start justify-between gap-6 sm:flex-col sm:items-end">
            <p class="font-semibold text-white">{{ formatPrice(item.price * item.quantity) }}</p>
            <button
                type="button"
                class="inline-flex size-9 items-center justify-center rounded-md text-slate-400 hover:bg-slate-800 hover:text-white"
                @click="removeItem"
            >
                <Trash2 class="size-4" />
            </button>
        </div>
    </div>
</template>
