<script setup lang="ts">
import { Bell, Search } from 'lucide-vue-next';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItem } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header class="flex flex-col gap-4 border-b border-[#0b3f70] bg-[#071c3c] px-6 py-4 shadow-sm text-white">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-4">
                <SidebarTrigger class="-ml-1 text-white/80" />
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-300">Admin panel</p>
                    <h1 class="text-lg font-semibold text-white">Fashion Store</h1>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative w-full min-w-55 sm:w-70">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-300">
                        <Search class="h-4 w-4" />
                    </span>
                    <input
                        id="admin-search"
                        placeholder="Search anything"
                        class="w-full rounded-full border border-[#0b3f70] bg-[#0c335c] py-2.5 pl-11 pr-4 text-sm text-white outline-none transition focus:border-[#1e4a83] focus:ring-2 focus:ring-[#0d4b8e]"
                        type="search"
                    />
                </div>
                <button
                    type="button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#0b3f70] text-white transition hover:bg-[#0d4b8e]"
                >
                    <Bell class="h-5 w-5" />
                </button>

                <div class="flex items-center gap-3 rounded-full border border-[#0b3f70] bg-[#0c335c] px-3 py-2">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#0d4b8e] text-xs font-semibold text-white">A</span>
                    <div class="text-sm">
                        <p class="font-medium text-white">Admin</p>
                        <p class="text-xs text-slate-300">Super user</p>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="breadcrumbs && breadcrumbs.length > 0">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </div>
    </header>
</template>
