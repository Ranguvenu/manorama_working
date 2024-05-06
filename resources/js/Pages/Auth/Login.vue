<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="login-text mb-4">
            <span class="font-bold mb-1 login-title inline-block">Login</span>
            <div class="text-xs login-msg text-gray-500 mt-2">New user ? <a class="text-blue" :href="route('register')">Register Here</a></div>
        </div>
        <form @submit.prevent="submit" class="py-4">
            <div class="username">
                <!--<InputLabel for="email" value="Email" />-->

                <TextInput
                    type="text"
                    class="mt-1 block w-full py-2"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="password mt-8">
                <!--<InputLabel for="password" value="Password" />-->

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full py-2"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"

                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-2 remember-label">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm">Remember username</span>
                </label>
            </div>

            <PrimaryButton class="mt-12 w-full justify-center capitalize login-btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
            </PrimaryButton>

            <div class="flex items-center justify-center mt-6 forgot-label">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-blue hover:text-blue-900 rounded-md focus:outline-none"
                >
                    Forgotten your username or password?
                </Link>
            </div>

            <div class="border-t my-4 pb-3"></div>
            <div class="w-full">
                <a :href="route('integrations.mhsso.authorize')" class="inline-flex items-center justify-center border rounded border-[#000] w-full text-center p-3">Continue with Manorama Online ID</a>
            </div>
        </form>
    </GuestLayout>
</template>
