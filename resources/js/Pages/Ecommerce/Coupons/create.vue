<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-coupon')" v-on:click="open_modal">Add Coupon</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Coupon</div>
            </template>
            <div class="grid grid-cols-12 gap-y-5 m-3">
            	<div class="col-span-12">
                    <div class="flex items-center">
                    	<InputLabel class="flex items-center w-2/3" for="type">Type <span class="text-red-600">*</span></InputLabel>
                    	<label class="flex items-center w-2/3">
                        	<input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" type="radio" value="0" v-model="form.type" v-bind:disabled="current" v-bind:enabled="!current"/>
                        	<span class="ml-2 text-sm text-gray-600">Global</span>
                        </label>
                        <label class="flex items-center w-2/3">
                        	<input class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" type="radio" value="1" v-model="form.type" v-bind:disabled="current" v-bind:enabled="!current"/>
                        	<span class="ml-2 text-sm text-gray-600">Package Lead</span>
                        </label>
                    </div>
                    <InputError class="mt-2" v-if="errors && errors.type" :message="errors.type[0]" />
                </div>
                <div class="col-span-12" v-if="form.type == 1 && isinitialized">
                    <InputLabel for="package_id">Packages sss<span class="text-red-600">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.packages" returns="id" :options="data.packages" label="title" :multiple="true"/>
                    <InputError class="mt-2" v-if="errors && errors.packages" :message="errors.packages[0]"/>
                </div>
                <div class="col-span-6">
                    <InputLabel for="code">Code <span class="text-red-600">*</span></InputLabel>
                    <TextInput
                        id="code"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.code"
                        autofocus
                        autocomplete="code"
                        v-bind:disabled="current"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]"/>
                </div>
                <div class="mt-5 col-span-6">
                    <Button size="sm" color="secondary" name="auto_generate" v-if="!current" v-on:click="autogenerate">Auto Generate</Button>
                </div>
                <div class="col-span-12">
                    <InputLabel for="discount_type">Discount Type <span class="text-red-600">*</span></InputLabel>
                    <select id="discount_type" class="mt-1 border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" :class="{'bg-gray-100': current}" v-model="form.discount_type" required v-bind:disabled="current">
                        <option disabled value="">Select discount type</option>
                        <option value="0">Fixed Amount</option>
                        <option value="1">Percentage Based Amount</option>
                    </select>
                    <div class="text-sm text-red-600" v-if="errors && errors.discount_type">{{ errors.discount_type[0] }}</div>
                </div>
                <div class="col-span-12">
                    <InputLabel for="discount_value">Discount Value <span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="discount_value"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.discount_value"
                        required
                        autofocus
                        autocomplete="discount_value"
                        v-bind:disabled="current"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                    />
                    <InputError class="mt-2" v-if="errors && errors.discount_value"  :message="errors.discount_value[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="valid_from">Valid From <span class="text-red-600">*</span></InputLabel>      
                    <TextInput
                        id="valid_from"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.valid_from"
                        autofocus
                        autocomplete="date"
                    />
                    <InputError class="mt-2" v-if="errors && errors.valid_from" :message="errors.valid_from[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="valid_to">Valid To <span class="text-red-600">*</span></InputLabel>      
                    <TextInput
                        id="valid_to"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.valid_to"
                        autofocus
                        autocomplete="date"
                    />
                    <InputError class="mt-2" v-if="errors && errors.valid_to" :message="errors.valid_to[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="coupon_usage_limit">Coupon Usage Limit<span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="coupon_usage_limit"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.coupon_usage_limit"
                        required
                        autofocus
                        autocomplete="coupon_usage_limit"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                    />
                    <InputError class="mt-2" v-if="errors && errors.coupon_usage_limit"  :message="errors.coupon_usage_limit[0]" />
                </div>
                <div class="col-span-12">
                    <InputLabel for="user_usage_limit">User Usage Limit<span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="user_usage_limit"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.user_usage_limit"
                        required
                        autofocus
                        autocomplete="user_usage_limit"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                    />
                    <InputError class="mt-2" v-if="errors && errors.user_usage_limit"  :message="errors.user_usage_limit[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Coupon</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Coupon</Button>
            </template>  
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from "@/Components/Button.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import PackagesAutoComplete from '@/Components/AutoComplete/Packages.vue';

export default{
    components:{
        SideModal,        
        InputError,
        InputLabel,
        TextInput,
        Checkbox,
        Button,
        MultiSelect,
        PackagesAutoComplete
    },
    props:{
        current: {
            type: Number,
            required: true
        }
    },
    data(){
        return{
            show: false,
            form: this.initialize(),
            errors: [],
            generatedcode: '',
            data: {
                packages: []
            },
            isinitialized: false,
        }
    },
    methods:{
        initialize(){
            return{
            	type: '',
            	packages: [],
                code: '',
                auto_generate: 0,
                discount_type: '',
                discount_value: '',
                valid_from: '',
				valid_to: '',
				coupon_usage_limit: 1,
				user_usage_limit: '',
            }
        },
        create(){
            let vm = this;
            axios.get(route('ecommerce.coupons.create')).then(response => {
                vm.data = response.data;
                // console.log('options',vm.data)
                vm.isinitialized = true;
            }).catch(error =>{

            });
        },
        autogenerate(){
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let code = '';
            let length = 12;   
            for (let i = 0; i < length; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            this.form.code = code;
        },
        store(){
            let vm = this;
            axios.post(route('ecommerce.coupons.store'), vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Coupon', {                        
                    position: 'bottom-right'
                });
            });
        },
        edit(coupon){
            let vm = this;
            axios.get(route('ecommerce.coupons.edit', { coupon: coupon })).then(response => {
                this.form = response.data.data;
                this.generatedcode = 1;
                if (this.form && this.form.packages && this.form.packages.length == 0) {
                    this.form.type = 0;
                } else {
                    this.form.type = 1;
                }
                this.show = true;
            }).catch(error => {

            });
        },
        update(coupon){
            let vm = this;
            axios.put(route('ecommerce.coupons.update', { coupon: coupon }), vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',
                    });
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               this.$toast.error('Failed to Update Coupon', {                        
                    position: 'bottom-right'
                });
            });
        },
        open_modal(){
            this.create();
            this.show = true;
        },
        close_modal(){
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
        }
    },
    watch: {
        current(){
            if(this.current){
                this.create();
                this.edit(this.current);
            }
        },
    },
    mounted(){
        
    }
}
</script>
