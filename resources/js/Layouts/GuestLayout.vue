<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white" id="login-index">
        <div class="sm:max-w-md lg:max-w-xl px-8">
            <Link href="/">
                <img src="/images/loginlogo.png" alt="Login Logo">
            </Link>
        </div>

        <div
            class="login-container w-full sm:max-w-md lg:max-w-xl mt-6 px-12 py-12 bg-white overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
