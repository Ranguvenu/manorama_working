<script setup>
import Modal from '@/Components/Modal.vue';
import Button from "@/Components/Button.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, defineEmits } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['close']);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('close');
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};

const close_modal = () => {
    emit('close');
    window.location.reload();
};
</script>
<template>
    <Modal :show="show" max-width="xl" @close="$emit('close')">
        <template #header>
            <div class="text-lg">Change Password</div>
        </template>
        <div class="px-3" v-if="show">
            <div class="mt-2">
                <InputLabel for="current_password" value="Current Password" />
                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>
            <div class="mt-5">
                <InputLabel for="password" value="New Password" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>
            <div class="mt-5">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>
        </div>
        <template #footer>
            <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
            <Button size="sm" color="primary" v-on:click="updatePassword">Change Password</Button>
        </template>
    </Modal>
</template>
