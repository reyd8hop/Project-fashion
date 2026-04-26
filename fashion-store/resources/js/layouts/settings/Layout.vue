<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { User, ShieldCheck, Palette } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { toUrl } from '@/lib/utils';
import { logout } from '@/routes';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editProfile } from '@/routes/profile';
import { edit as editSecurity } from '@/routes/security';
import type { NavItem } from '@/types';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: editProfile(),
        icon: User,
    },
    {
        title: 'Security',
        href: editSecurity(),
        icon: ShieldCheck,
    },
    {
        title: 'Appearance',
        href: editAppearance(),
        icon: Palette,
    },
];

const { isCurrentOrParentUrl } = useCurrentUrl();
</script>

<template>
    <div class="min-h-screen bg-[#071c3c] px-4 py-10 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl rounded-4xl bg-slate-950/95 p-6 shadow-[0_30px_90px_-35px_rgba(15,23,42,0.35)] ring-1 ring-white/10 sm:p-10">
            <div class="mb-8 space-y-4">
                <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                    Settings
                </h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-300">
                    Manage your profile and account settings in a clean interface styled to match the website.
                </p>
            </div>

            <div class="flex flex-col gap-8">
                <div class="flex flex-col gap-4 rounded-4xl bg-slate-900/90 p-4 shadow-inner sm:flex-row sm:items-center sm:justify-between">
                    <nav class="flex flex-wrap gap-3" aria-label="Settings">
                        <Button
                            v-for="item in sidebarNavItems"
                            :key="toUrl(item.href)"
                            variant="ghost"
                            :class="[
                                'inline-flex items-center rounded-2xl px-4 py-3 text-sm font-semibold transition',
                                isCurrentOrParentUrl(item.href)
                                    ? 'bg-slate-200 text-[#071c3c]'
                                    : 'text-slate-200 hover:bg-slate-800/80 hover:text-white',
                            ]"
                            as-child
                        >
                            <Link :href="item.href">
                                <component :is="item.icon" class="mr-2 h-4 w-4" />
                                {{ item.title }}
                            </Link>
                        </Button>
                    </nav>

                    <Form v-bind="logout.form()" class="inline-flex">
                        <Button variant="secondary" type="submit" class="rounded-2xl px-4 py-3 text-sm font-semibold">
                            Log out
                        </Button>
                    </Form>
                </div>

                <div class="space-y-10">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
