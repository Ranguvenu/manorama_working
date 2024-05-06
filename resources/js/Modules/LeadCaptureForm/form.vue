<template>
    <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-12">
        <div class="col-span-12">
            <InputLabel for="name" class="text-zinc-950 text-sm font-medium">Name <span class="text-red-400">*</span></InputLabel>
            <TextInput
                type="text"
                v-model="data.name"
                class="bg-white rounded-[5px] border border-neutral-200 block w-full"
                required
                autofocus
                />
            <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]"/>
        </div>
        <div class="col-span-12">
            <InputLabel for="email" class="text-zinc-950 text-sm font-medium">Email <span class="text-red-400">*</span></InputLabel>
            <TextInput
                type="text"
                v-model="data.email"
                class="bg-white rounded-[5px] border border-neutral-200 block w-full"
                required
                autofocus
                />
            <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
        </div>
        <div class="col-span-12">
            <InputLabel for="phone" class="text-zinc-950 text-sm font-medium">Phone Number <span class="text-red-400">*</span></InputLabel>
            <PhoneNumber
                id="phone"
                class="bg-white border-neutral-200 block w-full"
                v-model="data.phone"
                autofocus
                autocomplete="phone"
            />
            <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]"/>
            <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]"/>
        </div>
        <div class="col-span-12">
            <InputLabel for="place">Place <span class="text-red-400">*</span></InputLabel>
            <TextInput
                type="text"
                class="bg-white rounded-[5px] border border-neutral-200 block w-full"
                v-model="data.received_from"
                required
                autofocus
                />
            <InputError class="mt-2" v-if="errors && errors.received_from" :message="errors.received_from[0]" />
        </div>
        <div class="col-span-12">
            <InputLabel for="courses">Courses interested for <span class="text-red-400">*</span></InputLabel>
            <select style="border-radius: 0.4rem; border: 1px solid #d9d9d9;" v-model="data.tags" class="bg-white border-neutral-200 block w-full" >
                <option v-for="(goal, index) in options.goals" :value="goal.title">{{ goal.title }}</option>
            </select>
            <InputError class="mt-2" v-if="errors && errors.tags" :message="errors.tags[0]" />
        </div>
        <div class="col-span-12">
            <div class="inline-flex">
            <Checkbox name="termsandconditions" v-model:checked="data.termsandconditions" />
             <InputLabel  class ="ml-2" for="termsandconditions">I accept terms & conditions <span class="text-red-400">*</span></InputLabel>
             
             </div>
             <InputError class="mt-2" v-if="errors && errors.termsandconditions" :message="errors.termsandconditions[0]" />
        </div>
        <div class="col-span-12">
            <button class="bg-primary text-white py-3 px-3 w-full rounded-lg text-lg" :class="{'cursor-not-allowed pointer-events-none': isloading}"  v-on:click="$emit('submit')"><LoaderButton :loading="isloading">Submit</LoaderButton></button>   
        </div>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';
import Checkbox from '@/Components/Checkbox.vue';
export default{
    components:{
        InputLabel,
        InputError,
        TextInput,
        PhoneNumber,
        Checkbox
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
        options: {
            type: Object,
            required: true
        },
        isloading: {
            type: Boolean,
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
