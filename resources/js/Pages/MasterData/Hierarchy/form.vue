<template>
    <Modal :show="show" max-width="2xl" @close="close_modal">
        <template #header>
            <div class="text-lg"><span v-if="form.id">Edit</span><span v-else>Add</span> {{ hierarchy.label }}</div>
        </template>
        <div class="mx-2">
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-12">
                <div class="sm:col-span-12">
                    <InputLabel for="title">Name <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.title"
                        autofocus
                        autocomplete="title"
                    />
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]"/>
                </div>
                <div class="sm:col-span-12">
                    <InputLabel for="title">Code <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="code"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.code"
                        autofocus
                        autocomplete="code"
                        :disabled="form.id ? true :  false"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]"/>
                </div>
                <div class="sm:col-span-12" v-if="form.fields">
                    <InputLabel for="description">Description </InputLabel>
                    <CkEditor v-model="form.description" />
                </div>
                <div class="sm:col-span-12" v-if="form.fields">
                    <InputLabel for="image">Image</InputLabel>
                    <MediaButton class="mt-2" component="image" name="Select Image" :multiple="false" return_type="url" v-model="form.image"/>
                    <InputError class="mt-2" v-if="errors && errors.image" :message="errors.image[0]"/>
                </div>
                <div class="sm:col-span-12" v-if="form.fields">
                    <InputLabel for="address">Tags</InputLabel>
                    <TextArea
                        id="tags"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.tags"
                        required
                        autofocus
                        autocomplete="tags"
                    />
                    <InputError class="mt-2"  v-if="errors && errors.tags" :message="errors.tags[0]" />
                </div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default"  v-on:click="close_modal">Close</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-if="!form.id" v-on:click="store">Create</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-if="form.id" v-on:click="update(form.id)">Update</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import ButtonRegular from '@/Components/Button.vue';
import axios from 'axios';
import CkEditor from '@/Components/CkEditor.vue';
import MediaButton from '@/Components/MediaButton.vue';
import TextArea from '@/Components/TextArea.vue';

    export default {
        emits: ['refresh','close'],
        props:{
            show: {
                type: Boolean,
                required: true
            },
            hierarchy:{
                type: Object,
                required: true
            }
        },
        components:{
            Modal,
            InputLabel,
            TextInput,
            InputError,
            ButtonRegular,
            CkEditor,
            MediaButton,
            TextArea,
        },
        data(){
            return{
                form: {},
                errors: '',
            }
        },
        methods:{
            initialize(){
                return {
                    title: '',
                    code: '',
                    description: '',
                    image: '',
                    type_id: this.hierarchy.type,
                    parent_id: this.hierarchy.parent,
                    depth: this.hierarchy.depth,
                    fields: this.hierarchy.extrafields,
                    tags: '',
                }
            },
            close_modal(){
                this.errors = [];
                this.$emit('close');
            },
            store(){
                let vm = this;
                axios.post(route('masterdata.hierarchy.store'), vm.form).then(response => {
                    vm.$emit('refresh',vm.hierarchy.type);
                    vm.$emit('close');
                    if (response.data.success) {
                        vm.errors = '';
                        this.$toast.success('Created Hierarchy', {
                            position: 'bottom-right'
                        });
                    } else {
                        this.$toast.error('Failed to Create Hierarchy', {
                            position: 'bottom-right'
                        });                        
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
            
                });
            },
            edit(id){
                let vm = this;
                axios.get(route('masterdata.hierarchy.edit', {hierarchy: id})).then(response => {
                    this.form = response.data;
                }).catch(error => {

                });
            },
            update(id){
                let vm = this;
                axios.post(route('masterdata.hierarchy.update', {hierarchy: id}), vm.form).then(response => {
                    vm.$emit('refresh');
                    vm.$emit('close');
                    if (response.data.success) {
                        vm.errors = '';
                        this.$toast.success('Updated Hierarchy', {
                            position: 'bottom-right'
                        });
                    } else {
                        this.$toast.error('Failed to Update Hierarchy', {                        
                            position: 'bottom-right'
                        });
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                
                });
            }
        },
        watch: {
            show(){
                if(this.hierarchy && this.hierarchy.edit){
                    this.edit(this.hierarchy.edit);
                }else{
                    this.form = this.initialize();
                }
            }
        },
        mounted(){

        }
    }
</script>
