<template>
    <div>
        <div class="pb-5 border-b border-gray-200">
            <div class="text-center">
                <div class="text-xl font-semibold">Create your account</div>
                <div class="text-gray-600 mt-2">Already have an account ? <a class="text-blue" :href="route('dashboard')">Sign In</a></div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-12">
            <div class="col-span-6">
                <InputLabel for="firstname" class="text-zinc-950 text-sm font-medium">First Name <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="firstname"
                    type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    v-model="data.firstname"
                    required
                    autofocus
                    autocomplete="firstname"/>
                <InputError class="mt-2" v-if="errors && errors.firstname" :message="errors.firstname[0]" />
            </div>
            <div class="col-span-6">
                <InputLabel for="lastname" class="text-zinc-950 text-sm font-medium">Last Name <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="lastname"
                    type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    v-model="data.lastname"
                    required
                    autofocus
                    autocomplete="firstname"/>
                <InputError class="mt-2" v-if="errors && errors.lastname" :message="errors.lastname[0]" />
            </div>
            <div class="col-span-12">
                <InputLabel for="email" class="text-zinc-950 text-sm font-medium">Email <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="email"
                    type="email"
                    v-model="data.email"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    required
                    autofocus
                    autocomplete="email"
                    />
                <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
            </div>
            <div class="col-span-12">
                <InputLabel for="phonenumber" class="text-zinc-950 text-sm font-medium">Phone Number<span class="text-red-400"> *</span></InputLabel>
                <PhoneNumber
                    id="phone_number"
                    class="mb-1 bg-white border-neutral-200 block w-full mt-2"
                    v-model="data.phone"
                    autofocus
                    autocomplete="phone_number"
                />
                <small class="text-gray-600 mt-2">We will send an OTP to verify your mobile number</small>
                <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]"/>
                    <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]"/>
               
            </div>
            <div class="col-span-12">
                <InputLabel for="password" class="text-zinc-950 text-sm font-medium">Password <span class="text-red-400">*</span></InputLabel>
                <TextInput
                    id="password"
                    type="password"
                    v-model="data.password"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    required
                    autofocus
                    />
                <InputError class="mt-2" v-if="errors && errors.password" :message="errors.password[0]" />
            </div>
            <div class="col-span-12 mt-5">
                <button class="bg-primary text-center text-white py-3 px-3 w-full rounded-lg text-lg" :class="{'cursor-not-allowed pointer-events-none': isloading}" v-on:click="$emit('submit')"><LoaderButton :loading="isloading">Create Account</LoaderButton></button>   
            </div>
        </div>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';
export default{
    props:{
        data:{
            type: Object,
            required: true
        },
        errors: {
            type: Object,
            required: true
        },
        isloading: {
            type: Boolean,
            required: true
        }
    },
    components:{
        ButtonRegular,
        InputLabel,
        InputError,
        TextInput,
        PhoneNumber,
        LoaderButton
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>
