<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import OTPInput from '@/Components/OTPInput.vue';

const props = defineProps({
    message: {
        type: String,
        default: ''
    }
});

const form = useForm({
    otp: ''
});

const submit = () => {
    form.post(route('2fa.store'), {
        onFinish: () => form.reset('otp'),
    });
};

function logout() {
    let payload = {};
    axios.post(route('logout'), payload).then((response) => {
        if (response && response.data.success) {
            window.location.href = response.data.url;
        }
    }).catch(error => {

    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="text-secondary cursor-pointer" v-on:click="logout">Back</div>
        <div class="login-text mb-4">
            <span class="font-bold mb-1 login-title inline-block">Enter OTP</span>
        </div>
        <form @submit.prevent="submit" class="py-4">
            <div class="otp text-center">
                <!--<InputLabel for="email" value="Email" />-->
                <OTPInput :digit-count="4" @update:otp="form.otp = $event"/>

                <InputError class="mt-2" :message="form.errors.otp" />
            </div>

            <PrimaryButton class="mt-12 w-full justify-center capitalize login-btn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
            </PrimaryButton>

            <div class="flex items-center justify-center mt-6 forgot-label">
                <Link
                    :href="route('2fa.resend')"
                    class="text-sm text-blue hover:text-blue-900 rounded-md focus:outline-none"
                >
                   Resend OTP
                </Link>
            </div>
            <div class="text-center text-gray-800 mt-4" v-if="props.message">{{ props.message }}</div>
        </form>
    </GuestLayout>
</template>
