<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineOptions({
    layout: {
        title: 'Create an account',
        description: 'Enter your details below to create your account',
    },
});
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen bg-[#071c3c] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto grid min-h-[calc(100vh-64px)] max-w-7xl items-center gap-10 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="flex min-h-130 flex-col justify-center gap-8 text-white">
                <div class="max-w-2xl space-y-4">
                    <span class="inline-flex rounded-full bg-[#0b3f70] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white/80">
                        Fashion Store
                    </span>
                    <div class="space-y-3">
                        <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">
                            Create your account
                        </h1>
                        <p class="text-base leading-7 text-slate-200">
                            Join our fashion community and get fast access to modern outfit inspiration, curated styles, and exclusive member benefits.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-4xl bg-white p-8 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.25)] sm:p-10">
                    <Form
                        v-bind="store.form()"
                        :reset-on-success="['password', 'password_confirmation']"
                        v-slot="{ errors, processing }"
                        class="space-y-6"
                    >
                        <div class="grid gap-5">
                            <div class="grid gap-2">
                                <Label for="name">Full name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="name"
                                    name="name"
                                    placeholder="Enter your full name"
                                    class="bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.name" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    :tabindex="2"
                                    autocomplete="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    class="bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="flex items-center justify-between gap-4">
                                    <Label for="password">Create password</Label>
                                    <span class="text-xs text-slate-500">8+ characters</span>
                                </div>
                                <PasswordInput
                                    id="password"
                                    required
                                    :tabindex="3"
                                    autocomplete="new-password"
                                    name="password"
                                    placeholder="••••••••"
                                    class="bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.password" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="password_confirmation">Confirm password</Label>
                                <PasswordInput
                                    id="password_confirmation"
                                    required
                                    :tabindex="4"
                                    autocomplete="new-password"
                                    name="password_confirmation"
                                    placeholder="Repeat your password"
                                    class="bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.password_confirmation" />
                            </div>
                        </div>

                        <Button
                            type="submit"
                            class="mt-2 w-full rounded-2xl bg-[#0b3f70] px-5 py-3 text-base font-semibold text-white transition hover:bg-[#123d6d]"
                            tabindex="5"
                            :disabled="processing"
                            data-test="register-user-button"
                        >
                            <Spinner v-if="processing" />
                            Create account
                        </Button>
                    </Form>

                    <div class="mt-5 border-t border-slate-200 pt-5 text-center text-sm text-slate-600">
                        Already have an account?
                        <TextLink
                            :href="login()"
                            class="font-semibold text-slate-950 hover:text-[#0b3f70]"
                            :tabindex="6"
                        >
                            Log in
                        </TextLink>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-4xl bg-[#0b3f70] shadow-xl h-130 sm:h-155 lg:h-170">
                <img
                    src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80"
                    alt="Person wearing trendy look"
                    class="h-full w-full object-cover opacity-90"
                />
                <div class="absolute inset-0 bg-linear-to-tr from-[#071c3c]/90 via-transparent to-[#071c3c]/20"></div>
            </div>
        </div>
    </div>
</template>
