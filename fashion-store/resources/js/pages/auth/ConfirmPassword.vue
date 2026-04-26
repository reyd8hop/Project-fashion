<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { store } from '@/routes/password/confirm';

defineOptions({
    layout: {
        title: 'Confirm your password',
        description:
            'This is a secure area of the application. Please confirm your password before continuing.',
    },
});
</script>

<template>
    <Head title="Confirm password" />

    <div class="h-screen overflow-hidden bg-[#071c3c]">
        <div class="mx-auto grid h-full max-w-4xl items-center px-4 py-10 sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden rounded-4xl bg-white p-8 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.25)] sm:p-10">
                <div class="mb-8 space-y-3">
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">
                        Confirm password
                    </h1>
                    <p class="text-sm leading-6 text-slate-600">
                        This is a secure area of the application. Please confirm your password before continuing.
                    </p>
                </div>

                <Form
                    v-bind="store.form()"
                    reset-on-success
                    class="space-y-6"
                    v-slot="{ errors, processing }"
                >
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label htmlFor="password">Password</Label>
                            <PasswordInput
                                id="password"
                                name="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="current-password"
                                autofocus
                            />
                            <InputError :message="errors.password" />
                        </div>
                    </div>

                    <Button
                        class="w-full rounded-2xl bg-[#0b3f70] px-4 py-3 text-base font-semibold text-white transition hover:bg-[#0d4b8e]"
                        :disabled="processing"
                        data-test="confirm-password-button"
                    >
                        <Spinner v-if="processing" />
                        Confirm password
                    </Button>
                </Form>
            </div>
        </div>
    </div>
</template>
