<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-downloadable-resource')" v-on:click="open_modal">Add Downloadable Resource</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Downloadable Resources</div>
            </template>
            <div class="px-3 my-2">
                <div>
                    <InputLabel for="title">Resource Title <span class="text-red-400">*</span></InputLabel>    
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.title"
                        required
                        autofocus
                        autocomplete="title"
                    />
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="description">Description<span class = "text-red-400">*</span></InputLabel>    
                    <CkEditor
                        id="description"
                        type="text"
                        class="block w-full"
                        v-model="form.description"
                        required
                        autofocus
                        autocomplete="description"
                    />
                    <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 mt-3">
                    <div class="sm:col-span-6">
                        <InputLabel for="publish_from">Publish From <span class="text-red-400">*</span></InputLabel>
                            <TextInput
                            id="publish_from"
                            type="date"
                            class="mt-2 block w-full"
                            v-model="form.publish_from"
                            required
                            autofocus
                            autocomplete="date"
                        />
                        <InputError class="mt-2" v-if="errors && errors.publish_from" :message="errors.publish_from[0]"/>
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="publish_to">Publish To <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="publish_to"
                            type="date"
                            class="mt-2 block w-full"
                            v-model="form.publish_to"
                            required
                            autofocus
                            autocomplete="date"
                        />
                        <InputError class="mt-2" v-if="errors && errors.publish_to" :message="errors.publish_to[0]" />
                    </div>
                </div>
                <div class="mt-3" v-if="isinitialized">
                    <InputLabel for="resource_type">Resource Type <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.resource_type_id" returns="id" :options="data.resource_types" label="name" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.resource_type_id" :message="errors.resource_type_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-3" for="resource">Resource <span class="text-red-400">*</span></InputLabel>
                    <MediaButton component="resource" name="Choose file" accepts="png,jpeg,jpg,svg,webp,pdf" :multiple="false" return_type="id" v-model="form.resource_id"/>
                    <InputError class="mt-2" v-if="errors && errors.resource_id" :message="errors.resource_id[0]" />
                </div>
                <div class="mt-3">
                    <span class="flex">
                        <label class="flex items-center">
                        <Checkbox name="is_active" v-model:checked="form.is_active" />
                        <span class="ml-2 text-sm text-gray-600">Is Active</span>
                        </label>
                    </span>
                    <InputError class="mt-2" v-if="errors && errors.is_active" :message="errors.is_active[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create</Button>
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
    import CkEditor from '@/Components/CkEditor.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import MultiSelect from "@/Components/MultiSelect.vue";
    export default{
        components:{
            SideModal,        
            InputError,
            InputLabel,
            TextInput,
            Checkbox,
            Button,
            CkEditor,
            MediaButton,
            MultiSelect
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
                data: {
                    resource_types: []
                },
                errors: [],
                isinitialized: false
            }
        },
        methods:{
            initialize(){
                return{
                    title: '',
                    description: '',
                    publish_from: '',
                    publish_to: '',
                    resource_type_id: '', 
                    resource_id: '',
                    is_active: 0
                }
            },
            create(){
                let vm = this;
                axios.get('/content/resources/create').then(response => {
                    vm.data = response.data
                    vm.isinitialized = true;
                }).catch(error => {

                });
            },
            edit(resource){
                let vm = this;
                axios.get('/content/resources/'+resource+'/edit').then(response => {
                    vm.form = response.data.data;
                    vm.show = true;
                }).catch(error => {

                });
            },
            store(){
                let vm = this;
                axios.post('/content/resources/store', vm.form).then(response => {
                    if(response.data.success){
                        vm.close_modal();
                        vm.$emit('refresh');
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                });
            },
            update(resource){
                let vm = this;
                axios.put('/content/resources/'+resource+'/update', vm.form).then(response => {
                    if(response.data.success){
                        vm.close_modal();
                        vm.$emit('refresh');
                    }
                }).catch(error => {
                   vm.errors = error.response.data.errors;
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
            }
        },
        mounted(){
            
        }
    }
</script>
