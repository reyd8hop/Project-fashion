<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Log in to your account',
        description: 'Enter your email and password below to log in',
    },
});

const props = defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
    defaultRole: 'user' | 'admin';
}>();

const selectedRole = ref<'user' | 'admin'>(props.defaultRole);
</script>

<template>
    <Head title="Log in" />

    <div class="h-screen overflow-hidden bg-[#071c3c]">
        <div class="mx-auto grid h-full max-w-7xl items-center gap-8 px-4 py-6 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
            <div class="flex h-full flex-col justify-center space-y-8 text-white">
                <div class="space-y-4">
                    <span class="inline-flex rounded-full bg-[#0b3f70] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white/80">
                        Fashion Store
                    </span>
                    <div class="space-y-3">
                        <h1 class="text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                            Hola, Welcome Back
                        </h1>
                        <p class="max-w-2xl text-base leading-7 text-slate-200">
                            Hey, welcome back to your special place. Sign in to continue exploring modern outfits and curated everyday style.
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-4xl bg-white p-8 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.25)] sm:p-10">
                    <div v-if="status" class="mb-6 rounded-2xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ status }}
                    </div>

                    <Form
                        v-bind="store.form()"
                        :reset-on-success="['password']"
                        v-slot="{ errors, processing }"
                        class="space-y-6"
                    >
                        <div class="grid gap-4">
                            <div>
                                <Label>Login sebagai</Label>
                                <div class="mt-3 grid grid-cols-2 gap-3">
                                    <label
                                        class="flex cursor-pointer items-center justify-center rounded-2xl border px-4 py-3 text-sm font-medium transition"
                                        :class="selectedRole === 'user'
                                            ? 'border-[#0b3f70] bg-[#0b3f70] text-white shadow-sm shadow-slate-950/20'
                                            : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300 hover:bg-slate-100'"
                                    >
                                        <input
                                            class="sr-only"
                                            name="role"
                                            type="radio"
                                            value="user"
                                            v-model="selectedRole"
                                        />
                                        User
                                    </label>
                                    <label
                                        class="flex cursor-pointer items-center justify-center rounded-2xl border px-4 py-3 text-sm font-medium transition"
                                        :class="selectedRole === 'admin'
                                            ? 'border-[#0b3f70] bg-[#0b3f70] text-white shadow-sm shadow-slate-950/20'
                                            : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300 hover:bg-slate-100'"
                                    >
                                        <input
                                            class="sr-only"
                                            name="role"
                                            type="radio"
                                            value="admin"
                                            v-model="selectedRole"
                                        />
                                        Admin
                                    </label>
                                </div>
                                <InputError :message="errors.role" />
                            </div>

                            <div>
                                <Label for="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="email"
                                    placeholder="email@example.com"
                                    class="mt-2 bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.email" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-4">
                                    <Label for="password">Password</Label>
                                    <TextLink
                                        v-if="canResetPassword"
                                        :href="request()"
                                        class="text-sm text-slate-500 hover:text-slate-700"
                                        :tabindex="5"
                                    >
                                        Forgot password?
                                    </TextLink>
                                </div>
                                <PasswordInput
                                    id="password"
                                    name="password"
                                    required
                                    :tabindex="2"
                                    autocomplete="current-password"
                                    placeholder="Password"
                                    class="mt-2 bg-slate-50 border-slate-200"
                                />
                                <InputError :message="errors.password" />
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <Label for="remember" class="flex items-center space-x-3 text-sm text-slate-700">
                                    <Checkbox id="remember" name="remember" :tabindex="3" />
                                    <span>Remember me</span>
                                </Label>
                            </div>
                        </div>

                        <Button
                            type="submit"
                            class="mt-1 w-full rounded-2xl bg-[#0b3f70] px-5 py-3 text-base font-semibold text-white transition hover:bg-[#123d6d]"
                            :tabindex="4"
                            :disabled="processing"
                            data-test="login-button"
                        >
                            <Spinner v-if="processing" />
                            Log in
                        </Button>
                    </Form>

                    <div class="mt-4 text-center text-sm text-slate-600" v-if="canRegister">
                        Don't have an account?
                        <TextLink :href="register()" :tabindex="5" class="font-semibold text-slate-950 hover:text-violet-700">
                            Sign up
                        </TextLink>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-4xl bg-slate-950 shadow-xl h-[520px] sm:h-[620px] lg:h-[680px]">
                <img
                    src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=1200&q=80"
                    alt="Person wearing modern outfit"
                    class="h-full w-full object-cover opacity-90"
                />
                <div class="absolute inset-0 bg-linear-to-t from-slate-950/90 via-transparent to-slate-950/10"></div>
            </div>
        </div>
    </div>
</template>
