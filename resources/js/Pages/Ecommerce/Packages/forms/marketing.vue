<template>
    <div class="m-6">
        <div class="border bg-white p-3">
            <div class="grid grid-cols-12 gap-x-6 gap-y-5 sm:grid-cols-12">
                <div class="col-span-6">
                    <InputLabel for="package" class="mb-1">Page <span class="text-red-400">*</span></InputLabel>
                    <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="form.type">
                        <option value="1">Create a New Page</option>
                        <option value="0">Select Existing Page</option>
                    </select>
                </div>
                <div class="col-span-6" v-if="form.type == 0">
                    <InputLabel for="package" class="mb-1">Page <span class="text-red-400">*</span></InputLabel>
                    <PagesAutoComplete v-model="form.page_id" :data="options.pages" returns="id" label="title" :multiple="false" :disabled="false"/>
                </div>
                <div class="col-span-6" v-if="form.type == 1">
                    <InputLabel for="package" class="mb-1">Page Title <span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="form.title" placeholder="Title"/>
                </div>
                <div class="col-span-12">
                    <div class="float-right">
                        <ButtonRegular size="sm" color="primary" v-on:click="store">Save Changes</ButtonRegular>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PagesAutoComplete from '@/Components/AutoComplete/Pages.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonRegular from "@/Components/Button.vue";

export default{
    components:{
        PagesAutoComplete,
        InputLabel,
        TextInput,
        ButtonRegular
    },
    props:{
        data: {
            type: Object,
            required: true
        },
        edit: {
            type: Boolean,
            required: true
        },
        packagedata: {
            type: Object,
            required: true
        },
    },
    data(){
        return {
            form: {
                page_id: this.packagedata.page_id ? this.packagedata.page_id : 0,
                type: 0,
                title: ''
            },
            options: {
                pages: []
            },
            isloading: false
        }
    },
    methods: {
        store(){
            let vm = this;
            vm.isloading = true;
            axios.post(route('ecommerce.packages.marketing', {package:  vm.packagedata.id}), vm.form).then(response => {
                if (response.data.success) {
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }else{
                    this.$toast.error(response.data.message, {
                        position: 'bottom-right'
                    });
                }
                vm.isloading = false;
            }).catch(error => {

            });
        }
    },
    mounted(){

    }
}
</script>