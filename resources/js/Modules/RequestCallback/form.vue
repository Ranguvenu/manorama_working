<template>
    <div class="mx-3 requestcallback">
        <div class="flex py-5 border-b border-neutral-300">
            <SupportIcon/>
            <div class="ms-2">
                <div class="text-xl font-semibold">Talk to Our Experts</div>
                <div class="text-sm text-black mt-1">We're here to make things easier for you.</div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-12">
                <InputLabel for="name" class="text-black text-base font-medium">Your Name <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="name"
                    type="text"
                    class="bg-stone-50 rounded-[7px] border border-neutral-200 block w-full mt-2"
                    v-model="data.name"
                    required
                    autofocus
                    autocomplete="name"
                    :disabled="user"
                    />
                <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
            </div>
            <div class="col-span-12">
                <InputLabel for="phone_number" class="text-black text-base font-medium">Phone Number<span class="text-red-400">*</span></InputLabel>
                <PhoneNumber
                    id="phone_number"
                    class="bg-stone-50 rounded-[7px] border border-neutral-200 block w-full mt-2"
                    v-model="data.phone"
                    autofocus
                    autocomplete="phone_number"
                    :disabled="user"
                />
                <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]"/>
                <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]"/>
            </div>
            <div class="col-span-12">
                <InputLabel for="email" class="text-black text-base font-medium">Your Email <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="email"
                    type="email"
                    v-model="data.email"
                    class="bg-stone-50 rounded-[7px] border border-neutral-200 block w-full mt-2"
                    required
                    autofocus
                    autocomplete="email"
                    :disabled="user"
                    />
                <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
            </div>
            <div class="col-span-12">
                <button class="bg-primary text-white py-3 px-3 w-full rounded-lg text-lg" :class="{'cursor-not-allowed pointer-events-none': isloading}"  v-on:click="$emit('submit')"><LoaderButton :loading="isloading">Submit</LoaderButton></button>   
            </div>
        </div>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import Modal from '@/Components/Modal.vue';
import SupportIcon from '@/SvgIcons/SupportIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';

export default{
    components:{
        Modal,
        ButtonRegular,
        SupportIcon,
        InputLabel,
        InputError,
        TextInput,
        PhoneNumber,
        LoaderButton
    },
    props:{
        data:{
            type: Object,
            required: true
        },
        errors:{
            type: Object,
            required: true
        },
        isloading: {
            type: Boolean,
            default: false
        },
    },
    data(){
        return{
            user: this.$page.props.auth.user ? true : false,
        }
    },
    methods:{
        
    },
    mounted(){

    }
}
</script>
