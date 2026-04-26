<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ShoppingBag, ShoppingCart, UserRound } from 'lucide-vue-next';

const page = usePage();
const user = page.props.auth.user;
const isAdmin = user && user.role === 'admin';
const isUser = user && user.role === 'user';
</script>

<template>
    <header class="border-b border-[#0b3f70] bg-[#071c3c] text-white">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-white text-[#071c3c]">
                    <ShoppingBag class="size-5" />
                </div>
                <Link href="/" class="text-xl font-semibold tracking-tight text-white">
                    Fashion Store
                </Link>
            </div>

            <nav class="hidden items-center gap-2 text-sm font-medium text-slate-200 md:flex">
                <Link href="/" class="rounded-full px-4 py-2 transition hover:bg-[#0b3f70]">Home</Link>
                <Link v-if="!isAdmin && user" href="/cart" class="rounded-full px-4 py-2 transition hover:bg-[#0b3f70]">Cart</Link>
                <Link v-if="!isAdmin && user" href="/orders" class="rounded-full px-4 py-2 transition hover:bg-[#0b3f70]">Orders</Link>
                <Link v-if="isUser" href="#products" class="rounded-full px-4 py-2 transition hover:bg-[#0b3f70]">Products</Link>
                <Link v-if="isAdmin" href="/admin" class="rounded-full px-4 py-2 transition hover:bg-[#0b3f70]">Admin</Link>
            </nav>

            <div class="flex items-center gap-3">
                <Link
                    :href="page.props.auth.user ? '/settings/profile' : '/login'"
                    class="inline-flex items-center gap-2 rounded-full border border-[#0b3f70] bg-[#0b3f70] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0d4b8e]"
                >
                    <UserRound class="size-4" />
                    {{ page.props.auth.user ? 'Account' : 'Login' }}
                </Link>
            </div>
        </div>
    </header>
</template>
