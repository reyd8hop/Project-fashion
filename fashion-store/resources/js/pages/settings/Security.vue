<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { ShieldCheck } from 'lucide-vue-next';
import { onUnmounted, ref } from 'vue';
import SecurityController from '@/actions/App/Http/Controllers/Settings/SecurityController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { logout } from '@/routes';
import { edit } from '@/routes/security';
import { disable, enable } from '@/routes/two-factor';

type Props = {
    canManageTwoFactor?: boolean;
    requiresConfirmation?: boolean;
    twoFactorEnabled?: boolean;
};

withDefaults(defineProps<Props>(), {
    canManageTwoFactor: false,
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Security settings',
                href: edit(),
            },
        ],
    },
});

const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref<boolean>(false);

onUnmounted(() => clearTwoFactorAuthData());
</script>

<template>
    <Head title="Security settings" />

    <div class="min-h-screen bg-[#071c3c] px-4 py-10 text-white sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl space-y-8">
            <section class="overflow-hidden rounded-4xl bg-slate-950/95 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.35)] ring-1 ring-white/10 sm:p-8">
                <Heading
                    variant="small"
                    title="Update password"
                    description="Ensure your account is using a long, random password to stay secure"
                />

                <Form
                    v-bind="SecurityController.update.form()"
                    :options="{
                        preserveScroll: true,
                    }"
                    reset-on-success
                    :reset-on-error="[
                        'password',
                        'password_confirmation',
                        'current_password',
                    ]"
                    class="mt-6 space-y-6"
                    v-slot="{ errors, processing }"
                >
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="current_password">Current password</Label>
                            <PasswordInput
                                id="current_password"
                                name="current_password"
                                class="mt-1 block w-full"
                                autocomplete="current-password"
                                placeholder="Current password"
                            />
                            <InputError :message="errors.current_password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">New password</Label>
                            <PasswordInput
                                id="password"
                                name="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="New password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm password</Label>
                            <PasswordInput
                                id="password_confirmation"
                                name="password_confirmation"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="Confirm password"
                            />
                            <InputError :message="errors.password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <Button
                            :disabled="processing"
                            data-test="update-password-button"
                        >
                            Save password
                        </Button>
                    </div>
                </Form>
            </section>

            <section v-if="canManageTwoFactor" class="overflow-hidden rounded-4xl bg-slate-950/95 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.35)] ring-1 ring-white/10 sm:p-8">
                <Heading
                    variant="small"
                    title="Two-factor authentication"
                    description="Manage your two-factor authentication settings"
                />

                <div class="mt-6 space-y-6">
                    <div v-if="!twoFactorEnabled" class="space-y-4 text-slate-200">
                        <p class="text-sm text-slate-400">
                            When you enable two-factor authentication, you will be prompted
                            for a secure pin during login. This pin can be retrieved from a
                            TOTP-supported application on your phone.
                        </p>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <Button v-if="hasSetupData" @click="showSetupModal = true">
                                <ShieldCheck />Continue setup
                            </Button>
                            <Form
                                v-else
                                v-bind="enable.form()"
                                @success="showSetupModal = true"
                                #default="{ processing }"
                            >
                                <Button type="submit" :disabled="processing">
                                    Enable 2FA
                                </Button>
                            </Form>
                        </div>
                    </div>

                    <div v-else class="space-y-4 text-slate-200">
                        <p class="text-sm text-slate-400">
                            You will be prompted for a secure, random pin during login,
                            which you can retrieve from the TOTP-supported application on
                            your phone.
                        </p>

                        <Form v-bind="disable.form()" #default="{ processing }">
                            <Button
                                variant="destructive"
                                type="submit"
                                :disabled="processing"
                            >
                                Disable 2FA
                            </Button>
                        </Form>

                        <TwoFactorRecoveryCodes />
                    </div>

                    <TwoFactorSetupModal
                        v-model:isOpen="showSetupModal"
                        :requiresConfirmation="requiresConfirmation"
                        :twoFactorEnabled="twoFactorEnabled"
                    />
                </div>
            </section>

            <section class="overflow-hidden rounded-4xl bg-slate-950/95 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.35)] ring-1 ring-white/10 sm:p-8">
                <Heading
                    variant="small"
                    title="Account actions"
                    description="Manage your account settings"
                />

                <div class="mt-6 flex items-center justify-end">
                    <Form v-bind="logout.form()" class="inline">
                        <Button variant="destructive" type="submit">
                            Logout
                        </Button>
                    </Form>
                </div>
            </section>
        </div>
    </div>
</template>
