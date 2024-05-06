<template>
    <div>
        <Button size="sm" color="secondary" v-if="$has_capability('create-pricing')" v-on:click="open_modal">Add Pricing</Button>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Pricing</div>
            </template>
            <div class="mx-2">
                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12">
                    <div class="sm:col-span-12">
                        <div class="text-lg font-semibold dark:text-white">Pricing</div>
                    </div>
                    <div class="sm:col-span-12">
                        <InputLabel for="actual_price">Price <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="actual_price"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.actual_price"
                            autofocus
                            autocomplete="title"
                        />
                        <InputError class="mt-2" v-if="errors && errors.actual_price" :message="errors.actual_price[0]"/>
                    </div>
                    <div class="sm:col-span-12">
                        <InputLabel for="selling_price">Offer Price</InputLabel>
                        <TextInput
                            id="selling_price"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.selling_price"
                            autofocus
                            autocomplete="selling_price"
                        />
                        <InputError class="mt-2" v-if="errors && errors.selling_price" :message="errors.selling_price[0]"/>
                    </div>

                    <div class="sm:col-span-12">
                        <InputLabel for="subject">Subject <span class="text-red-400">*</span></InputLabel>
                        <MultiSelect class="mt-2" v-model="form.subjects" returns="id" :disabled="current" :options="options.courses" label="title" :multiple="true"/>
                        <InputError class="mt-2" v-if="errors && errors.subjects" :message="errors.subjects[0]"/>
                    </div>

                    <div class="sm:col-span-12">
                        <div class="text-lg font-semibold dark:text-white">SAP</div>
                    </div>

                    <div class="sm:col-span-12">
                        <InputLabel for="sap_type_id">Type ID <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="sap_type_id"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.sap_type_id"
                            autofocus
                        />
                        <InputError class="mt-2" v-if="errors && errors.sap_type_id" :message="errors.sap_type_id[0]"/>
                    </div>

                    <div class="sm:col-span-12">
                        <InputLabel for="sap_sub_type_id">Sub Type ID <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="sap_sub_type_id"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.sap_sub_type_id"
                            autofocus
                        />
                        <InputError class="mt-2" v-if="errors && errors.sap_sub_type_id" :message="errors.sap_sub_type_id[0]"/>
                    </div>

                    <div class="sm:col-span-12">
                        <InputLabel for="sap_ism_amount">ISM Amount <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="sap_ism_amount"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.sap_ism_amount"
                            autofocus
                            autocomplete="title"
                        />
                        <InputError class="mt-2" v-if="errors && errors.sap_ism_amount" :message="errors.sap_ism_amount[0]"/>
                    </div>
                    <div class="sm:col-span-12">
                        <InputLabel for="sap_ism_product_code">ISM Product Code <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="sap_ism_product_code"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.sap_ism_product_code"
                            autofocus
                            autocomplete="sap_ism_product_code"
                        />
                        <InputError class="mt-2" v-if="errors && errors.sap_ism_product_code" :message="errors.sap_ism_product_code[0]"/>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update">Update Pricing</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Pricing</Button>
            </template>  
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from "@/Components/Button.vue";
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';

export default{
    components:{
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        Button,
        ButtonOutline,
        MultiSelect
    },
    props:{
        packagedata: {
            type: Object,
            required: true
        },
        current: {
            type: Number,
            required: true
        }
    },
    data(){
        return{
            show: false,
            form: this.initialize(),
            options: {
                courses: [],
            },
            errors: []
        }
    },
    methods:{
        initialize(){
            return{
                actual_price: '',
                selling_price: '',
                course: '',
                sap_type_id: '',
                sap_sub_type_id: '',
                sap_ism_amount: '',
                sap_ism_product_code: ''
            }
        },
        edit(){
            let vm = this;
            axios.get(route('ecommerce.pricing.edit', {pricing: vm.current})).then(response => {
                vm.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post(route('ecommerce.pricing.store', {package: vm.packagedata.id}), vm.form).then(response => {
                vm.show = false;
                vm.close_modal();
                vm.$emit('index');
                this.$toast.success(response.data.message, {
                    position: 'bottom-right'
                });
                vm.form = this.initialize();
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Pricing', {                        
                        position: 'bottom-right'
                });
            });
        },
        update(){
            let vm = this;
            axios.put(route('ecommerce.pricing.update', {pricing: vm.current}), vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('index');
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to update pricing', {                        
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
        },
        create() {
            let vm = this;
            axios.get(route('ecommerce.pricing.create', {package: vm.packagedata.id})).then(response => {
                vm.options = response.data;
            }).catch(error => {

            });
        }
    },
    watch: {
        current(){
            if(this.current){
                this.create();
                this.edit(this.current);
            }
        },
        "form.selling_price": function(){
            if(this.form.actual_price == this.form.selling_price){
                this.form.selling_price = '';
            }
        },
    },
    mounted(){
        this.create();
    }
}
</script>
