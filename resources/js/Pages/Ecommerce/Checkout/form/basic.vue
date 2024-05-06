<template>
    <div class="bg-white rounded border-b-4 border-neutral-200 mb-4">
        <div class="flex items-center border border-b-1 border-gray-200 ps-6 py-3 border-t-0 border-x-0">
            <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 bg-indigo-800 rounded-[7px] me-2"><div class="text-center text-white text-base">1</div></div>
            <div class="text-zinc-800 text-base font-semibold">Basic Info</div>
        </div>
        <div class="flex flex-wrap text-black text-sm ps-6 py-6">
            <div class="w-full md:w-1/2 mb-6 pe-8">
                <label class="block mb-1" for="first_name">First Name</label>
                <div class="relative w-full">
                    <ExclamationCircleIcon  v-if='errors && errors["profile.firstname"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                    <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                    <input :class='{"!border-red-600": (errors && errors["profile.firstname"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] pr-8 block w-full" v-model="form.firstname">
                </div>
                <InputError class="mt-2" v-if='errors && errors["profile.firstname"]' :message='errors["profile.firstname"][0]' />
            </div>

            <div class="w-full md:w-1/2 mb-6 pe-8">
                <label class="block mb-1" for="last_name">Last Name</label>
                <div class="relative w-full">
                    <ExclamationCircleIcon  v-if='errors && errors["profile.lastname"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                    <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                    <input :class='{"!border-red-600": (errors && errors["profile.lastname"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.lastname">
                </div>
                <InputError class="mt-2" v-if='errors && errors["profile.lastname"]' :message='errors["profile.lastname"][0]' />
            </div>
            <div class="w-full md:w-1/2 mb-6 pe-8">
                <label class="block mb-1" for="email">Email Address</label>
                <div class="relative w-full">
                    <ExclamationCircleIcon  v-if='errors && errors["profile.email"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                    <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                    <input :class='{"!border-red-600": (errors && errors["profile.email"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.email" disabled="true">
                </div>
                <InputError class="mt-2" v-if='errors && errors["profile.email"]' :message='errors["profile.email"][0]' />
            </div>
            <div class="w-full md:w-1/2 mb-6 pe-8">
                <label class="block mb-1" for="phone">Phone Number</label>
                <div class="relative w-full">
                    <ExclamationCircleIcon  v-if='errors && errors["profile.phone_number"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                    <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                    <input :class='{"!border-red-600": (errors && errors["profile.phone_number"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.phone_number">
                </div>
                <InputError class="mt-2" v-if='errors && errors["profile.phone_number"]' :message='errors["profile.phone_number"][0]' />
            </div>
        </div>
    </div>
</template>
<script>
    import InputError from '@/Components/InputError.vue';
    import {ExclamationCircleIcon, CheckCircleIcon} from "@heroicons/vue/24/solid";
    export default {
        components:{        
            InputError,
            ExclamationCircleIcon,
            CheckCircleIcon
        },
        props:{
            form: {
                type: Object,
                required: true
            },
            errors: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                
            };
        },
        methods:{

        },
        mounted(){

        }
    };
</script>
