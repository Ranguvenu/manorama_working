<template>
    <div>
        <div class="flex py-5 border-b border-gray-200">
            <div class="ms-2">
                <div class="text-xl font-semibold">Verify your number</div>
                <div class="text-sm text-gray-600 mt-1">We send a verification code to {{ data.phone.code }} {{ data.phone.number }}</div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-12">
                <div class="text-center">
                    <OTPInput :digit-count="6" @update:otp="data.otp = $event"/>
                    <InputError class="mt-2" v-if="errors && errors.message" :message="errors.message" />
                </div>
            </div>
            <div class="col-span-12">
                <div class="flex items-center justify-center">
                    <a href="javascript:void()" class="text-blue text-md cursor-pointer" v-on:click="$emit('resend')">Resend OTP</a>
                </div>
            </div>
            <div class="col-span-12">
                <button class="bg-primary text-center text-white py-3 px-3 w-full rounded-lg text-lg" :class="{'cursor-not-allowed pointer-events-none': isloading}" v-on:click="$emit('submit')"><LoaderButton :loading="isloading">Submit</LoaderButton></button>   
            </div>
        </div>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import OTPInput from '@/Components/OTPInput.vue';
    import LoaderButton from '@/SvgIcons/LoaderButton.vue';

    export default{
        props:{
            data: {
                type: Object,
                required: true
            },
            errors: {
                type: Object,
                required: false
            },
            isloading: {
                type: Boolean,
                required: true
            }
        },
        components:{
            TextInput,
            InputError,
            OTPInput,
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
