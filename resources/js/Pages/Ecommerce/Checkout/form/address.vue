<template>
     <div class=" bg-white rounded border-b-4 border-neutral-200 mb-4">
          <div class="flex items-center border border-b-1 border-gray-200 ps-6 py-3 border-t-0 border-x-0">
               <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 bg-indigo-800 rounded-[7px] me-2">
                    <div class="text-center text-white text-base">2</div>
               </div>
               <div class="text-zinc-800 text-base font-semibold">Address</div>
          </div>
          <div class="flex flex-wrap text-black text-sm ps-6 py-6">
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="address_line_one">Address Line 1</label>
                    <div class="relative w-full">
                         <ExclamationCircleIcon  v-if='errors && errors["profile.address"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <input :class='{"!border-red-600": (errors && errors["profile.address"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8 border-stone-300" v-model="form.address">
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.address"]' :message='errors["profile.address"][0]' />
               </div>
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="address_line_two">Address Line 2</label>
                    <div class="relative w-full">
                         <ExclamationCircleIcon  v-if='errors && errors["profile.address2"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <input :class='{"!border-red-600": (errors && errors["profile.address2"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.address2">
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.address2"]' :message='errors["profile.address2"][0]' />
               </div>
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="country">Country</label>
                    <div class="relative w-full">
                         <ExclamationCircleIcon  v-if='errors && errors["profile.country"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <MultiSelect :class='{"!broder !border-red-600": (errors && errors["profile.country"])}' v-model="form.country" returns="id" :options="options.countries" label="name" :multiple="false" />
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.country"]' :message='errors["profile.country"][0]' />
               </div>
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="state">State</label>
                    <div>
                         <ExclamationCircleIcon  v-if='errors && errors["profile.state"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <MultiSelect :class='{"!border-red-600": (errors && errors["profile.state"])}' v-model="form.state" returns="id" :options="states" label="name" :multiple="false" />
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.state"]' :message='errors["profile.state"][0]' />
               </div>
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="city">City</label>
                    <div class="relative w-full">
                         <ExclamationCircleIcon  v-if='errors && errors["profile.city"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <input :class='{"!border-red-600": (errors && errors["profile.city"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.city">
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.city"]' :message='errors["profile.city"][0]' />
               </div>
               <div class="w-full md:w-1/2 mb-6 pe-8">
                    <label class="block mb-1" for="pincode">Pincode</label>
                    <div class="relative w-full">
                         <ExclamationCircleIcon  v-if='errors && errors["profile.pincode"]'  class="w-6 h-6 absolute right-1 top-[6px] text-red-600"/>
                         <!-- <CheckCircleIcon v-else class="w-6 h-6 absolute right-1 top-[6px] text-green-600"/> -->
                         <input :class='{"!border-red-600": (errors && errors["profile.pincode"])}' type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full pr-8" v-model="form.pincode" 
                         onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                    <InputError class="mt-2" v-if='errors && errors["profile.pincode"]' :message='errors["profile.pincode"][0]' />
               </div>
          </div>
     </div>
</template>
<script>
import MultiSelect from '@/Components/MultiSelect.vue';
import InputError from '@/Components/InputError.vue';
import {ExclamationCircleIcon, CheckCircleIcon} from "@heroicons/vue/24/solid";

export default {
     components: {
          InputError,
          MultiSelect,
          ExclamationCircleIcon,
          CheckCircleIcon
     },
     props: {
          form: {
               type: Object,
               required: true
          },
          options: {
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
               states: []
          }
     },
     methods: {
          get_states(){
               let vm = this;
               axios.get(route('getstates', { country: vm.form.country })).then(response => {
                    vm.states = response.data;
               }).catch( (error) =>{

               });
          }
     },
     watch: {
          'form.country': function () {
               if (this.form.country) {
                    this.get_states();
               }
          }
     },
     mounted() {
          
     }
}
</script>
