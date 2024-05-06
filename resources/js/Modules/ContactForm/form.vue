<template>
    <div class="flex flex-col md:w-1/2 w-full mt-2">
        <div class="max-w-[563px]">
            <div class="text-black text-[22px] font-semibold mb-4">Write To Us</div>
            <div class="text-black text-base font-medium mb-4">You will typically hear from us within 24 hours</div>
            <div class="mb-3">
                <InputLabel for="name" class="text-zinc-950 text-sm font-medium">Name <span class="text-red-600">*</span></InputLabel>
                <TextInput
                    id="name"
                    type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    v-model="data.name"
                    required
                    autofocus
                    autocomplete="name"
                    />
                <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
            </div>
            <div class="mb-3">
                <InputLabel for="email" class="text-zinc-950 text-sm font-medium">Email <span class="text-red-600">*</span></InputLabel>
                <TextInput
                    id="email"
                    type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2"
                    v-model="data.email"
                    required
                    autofocus
                    autocomplete="email"
                    />
                <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
            </div>
            <div class="mb-3">
                <InputLabel for="phone" class="text-zinc-950 text-sm font-medium">Phone Number <span class="text-red-600">*</span></InputLabel>
                <PhoneNumber
                    id="phone"
                    class="border-neutral-200 block w-full mt-2"
                    v-model="data.phone"
                    autofocus
                    autocomplete="phone"
                />
                <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]" />
                <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]" />
            </div>
            <div class="mb-3">
                <InputLabel for="message" class="text-zinc-950 text-sm font-medium">Message</InputLabel>
                <TextArea
                    id="message"
                    type="text"
                    class="bg-white rounded-[5px] border border-neutral-200 block w-full mt-2 min-h-[150px]"
                    v-model="data.message"
                    required
                    autofocus
                    autocomplete="message"
                    />
                <InputError class="mt-2" v-if="errors && errors.message" :message="errors.message[0]" />
            </div>
            <button class="w-full py-[13px] bg-rose-600 rounded-[9px] justify-center items-start gap-2.5 inline-flex text-white text-xl font-medium" size="sm:m-0 h-[47px]" v-on:click="$emit('submit')">Submit</button>
        </div>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
import SupportIcon from '@/SvgIcons/SupportIcon.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';
export default{
    components:{
        ButtonRegular,
        SupportIcon,
        InputLabel,
        InputError,
        TextInput,
        TextArea,
        PhoneNumber
    },
    props:{
        data:{
            type: Object,
            required: true
        },
        errors:{
            type: Object,
            required: true
        }
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
