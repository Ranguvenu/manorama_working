<template>
    <ButtonRegular color="primary" size="sm" v-on:click="show = true">{{ title }}</ButtonRegular>
    <Modal max-width="2xl" :show="show" @close="close_modal">
        <template #header>
            <div>{{ title }}</div>
        </template>
        <div class="px-3 py-5">
            <ModalLoader class="loader" :isloading="isloading"></ModalLoader>
            <div class="flow-root">
                <div class="pb-5 float-right" v-if="sample">
                    <a :href="sample" class="text-primary" target="__blank">Download Sample Csv</a>
                </div>
                <div class="float-left w-full">
                    <input type="file" name="file" @change="upload"/>
                    <InputError class="mt-2" v-if="errors && errors.file" :message="errors.file[0]"/>
                </div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="close_modal">Close</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-on:click="store">Upload</ButtonRegular>
        </template>
    </Modal>
    <ImportSummary :title="title" :data="summary" :headers="headers" :show="show_summary" @hide="close_summary"/>
</template>
<script>
    import Modal from '@/Components/Modal.vue'; 
    import ButtonRegular from '@/Components/Button.vue';
    import ImportSummary from './summary.vue';
    import ModalLoader from '@/Components/ModalLoader.vue';
    import InputError from '@/Components/InputError.vue';

    export default{
        props: {
            title: {
                type: String,
                required: true
            },
            component: {
                type: String,
                required: true
            },
            headers: {
                type: Object,
                required: false
            },
            sample: {
                type: String,
                default: ''
            }
        },
        components:{
            Modal,
            ButtonRegular,
            ImportSummary,
            ModalLoader,
            InputError
        },
        data(){
            return{
                show: false,
                file: '',
                show_summary: false,
                summary: [],
                isloading: false,
                errors: []
            }
        },
        methods:{
            upload(event) {
                this.file = event.target.files ? event.target.files[0] : null;
            },
            store(){
                let vm = this;
                vm.isloading = true;
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                formData.append('file', vm.file);
                formData.append('component', vm.component);
                axios.post(route('jsonupload.store'), formData, config).then(function (response) {
                    vm.summary = response.data;
                    if (vm.summary.length > 0) {
                        vm.show_summary = true;
                    } else {
                        window.location = window.location.origin+'/ecommerce/orders';
                    }
                    vm.isloading = false;
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    vm.isloading = false;
                });
            },
            close_summary(){
                this.show_summary = false;
                this.show = false;
                this.errors = [];
                this.file = '';
                this.$emit('refresh');
            },
            close_modal(){
                this.show = false;
                this.errors = [];
                this.file = '';
            }
        },
        mounted(){
            
        }
    }
</script>
