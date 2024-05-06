<template>
    <div class="flex flex-wrap justify-center mb-6">
        <div class="media_sm:w-full sm:mr-6 mb-2 media_sm:mb-4">
            <InputLabel for="name" class="text-zinc-950 text-base font-semibold">Name</InputLabel>
            <TextInput type="text" class=" rounded border border-neutral-300 block w-full"
                v-model="form.name" required autofocus autocomplete="name" />
            <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
        </div>
        <div class="media_sm:w-full sm:mr-6 mb-2 media_sm:mb-4">
            <InputLabel for="phnumber" class="text-zinc-950 text-base font-semibold">Phone Number</InputLabel>
            <PhoneNumber
                id="phone"
                class="bg-opacity-90 block w-full"
                v-model="form.phone"
                autofocus
                autocomplete="phone"
            />
            <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]" />
            <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]" />
        </div>
        <div class="media_sm:w-full sm:mr-6 mb-2 media_sm:mb-4">
            <InputLabel for="email" class="text-zinc-950 text-base font-semibold">Email </InputLabel>
            <TextInput type="text" class="rounded border border-neutral-300 block w-full"
                v-model="form.email" required autofocus autocomplete="email" />
            <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
        </div>
    </div>
    <div class="flex justify-center">
        <Button v-on:click="submit" class="media_sm:block media_sm:w-full text-base leading-[27px]" size="sm:m-0 h-[47px]">{{ label }}</Button>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/Button.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';

export default {
    props: {
        label: {
            type: String,
            default: 'Enquire Now'
        }
    },
    components: {
        InputLabel,
        InputError,
        TextInput,
        Button,
        PhoneNumber,
    },
    data() {
        return {
            form: this.initialize(),
            errors: []
        }
    },
    methods: {
        initialize() {
            return {
                name: '',
                email: '',
                phone: {
                    code: '+91',
                    number: ''
                },
            }
        },
        submit() {
            let vm = this;
            axios.post(route('contact.store'), vm.form).then(response => {
                if(response.data.success){
                    vm.$toast.success(response.data.message,{
                        position: 'bottom-right'
                    });
                    vm.$emit('refresh');
                    this.form = this.initialize();
                    vm.errors = [];
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
    },
    mounted() {

    }
}
</script>
