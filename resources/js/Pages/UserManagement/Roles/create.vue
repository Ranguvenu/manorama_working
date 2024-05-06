<template>
    <div>
        <ButtonRegular size="sm" v-on:click="open_modal">Add Role</ButtonRegular>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Role</div>
            </template>
            <div class="px-3">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="sm:col-span-6">
                        <InputLabel for="fullname">Role Name <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-2 w-full"
                            v-model="form.fullname"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" v-if="errors && errors.fullname"  :message="errors.fullname[0]" />
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="shortname">Short Name <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-2 w-full"
                            v-model="form.name"
                            required
                            autofocus
                            :disabled="current ? true : false"
                            autocomplete="name"
                        />
                        <InputError class="mt-2" v-if="errors && errors.name"  :message="errors.name[0]" />
                    </div>
					<div class="sm:col-span-12">
						<InputLabel for="decription">Description <span class="text-red-400">*</span></InputLabel>
						<TextArea
                            id="description"
                            type="text"
                            class="mt-2 w-full"
                            v-model="form.description"
                            required
                            autofocus
                            autocomplete="description"
                        />
                        <InputError class="mt-2" v-if="errors && errors.description"  :message="errors.description[0]" />
					</div>
                    <div class="sm:col-span-6">
                        <div class="mt-3">
                            <InputLabel for="boards">LMS Roles <span class="text-red-400">*</span></InputLabel>
                            <MultiSelect class="board mt-2" v-model="form.mdlrole" returns="shortname" :options="data.mdlrole" label="shortname" :multiple="false"/>
                            <InputError class="mt-2" v-if="errors && errors.mdlrole" :message="errors.mdlrole[0]"/>
                        </div>
                    </div>
					<div class="sm:col-span-12">
                        <InputError class="mt-2" v-if="errors && errors.permissions"  :message="errors.permissions[0]" />
						<PermissionsInput :permissions="permissions" v-model="form.permissions"/>
					</div>
                </div>
            </div>
            <template #footer>
                <ButtonRegular size="sm" color="default"  v-on:click="close_modal">Close</ButtonRegular>
                <ButtonRegular size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update</ButtonRegular>
                <ButtonRegular size="sm" color="primary"  v-if="!current" v-on:click="store">Create</ButtonRegular>
            </template>
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Checkbox from '@/Components/Checkbox.vue';
import ButtonRegular from "@/Components/Button.vue";
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import PermissionsInput from './permissions.vue';
import axios from 'axios';

export default{
    components:{
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        ButtonRegular,
        ButtonOutline,
		PermissionsInput,
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
            errors: [],
            permissions: [],
            data: {
                mdlrole: [],
            }
        }
    },
    methods:{
        initialize(){
            return {
                name: '',
                fullname: '',
                description: '',
                permissions: []
            }
        },
        create(){
            let vm = this;
            axios.get('/users/roles/create').then(response => {
                vm.permissions = response.data.data;
                vm.data.mdlrole = response.data.mdlroles;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/users/roles/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');                           
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                if (this.$toast.error.length !== 0) {
                    this.$toast.clear();
                }
                this.$toast.error('Failed to Create Role', {                        
                    position: 'bottom-right'
                });
            });
        },
        edit(role){
            let vm = this;
            axios.get('/users/roles/'+role+'/edit').then(response => {
                vm.form = response.data.data;
                vm.show = true;
                vm.open_modal();
            }).catch(error => {

            });
        },
        update(role){
            let vm = this;
            axios.put('/users/roles/'+role+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                if (this.$toast.error.length !== 0) {
                    this.$toast.clear();
                }
                this.$toast.error('Failed to Update Role', {                        
                    position: 'bottom-right'
                });
            });
        },
        open_modal(){
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
        this.create();
    }
}
</script>
