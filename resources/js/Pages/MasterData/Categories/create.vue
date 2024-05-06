<template>
    <div>
        <Button size="sm" v-on:click="open_modal" v-if="$has_capability('create-'+taxonomy.slug)" >Add {{ taxonomy.singular }}</Button>
        <Modal :show="show" max-width="xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> {{ taxonomy.singular }}</div>
            </template>
            <div class="p-3">
                <div>
                    <InputLabel for="code">Name <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        placeholder="Enter Name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" v-if="errors && errors.name"  :message="errors.name[0]"/>
                </div>
            </div>
            <div class="p-3">
                <div>
                    <InputLabel for="code">Code <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.code"
                        placeholder="Enter Code"
                        required
                        autofocus
                        autocomplete="code"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code"  :message="errors.code[0]"/>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button :class="{'cursor-not-allowed pointer-events-none': isloading}" size="sm" color="primary"  v-if="current" v-on:click="update(current)"><LoaderButton :loading="isloading">Update</LoaderButton></Button>
                <Button :class="{'cursor-not-allowed pointer-events-none': isloading}" size="sm" color="primary"  v-if="!current" v-on:click="store"><LoaderButton :loading="isloading">Create {{ taxonomy.name }}</LoaderButton></Button>
            </template>
        </Modal>
    </div>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Button from "@/Components/Button.vue";
import ButtonOutline from '@/Components/ButtonOutline.vue';    
import axios from 'axios';
import LoaderButton from '@/SvgIcons/LoaderButton.vue';

export default{
    props:{
        taxonomy:{
            type: Object,
            required: true
        },
        current: {
            type: Number,
            required: true
        }
    },
    components:{
        Modal,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        Button,
        ButtonOutline,
        LoaderButton
    },
    data(){
        return{
            show: false,
            form: this.initialize(),
            errors: [],
            isloading: false
        }
    },
    methods:{
        initialize(){
            return {
                name: '',
                code: ''
            }
        },
        open_modal(){
            this.show = true;
        },
        close_modal(){
            this.form = this.initialize();
            this.show = false;
            this.errors = [];
            this.$emit('close');
        },
        store(){
            let vm = this;
            vm.isloading = true;
            axios.post("/masterdata/categories/"+vm.taxonomy.slug+"/store", vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    vm.isloading = false;
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                vm.isloading = false;
            });
        },
        edit(category){
            let vm = this;
            axios.get('/masterdata/categories/'+vm.taxonomy.slug+'/'+category+'/edit').then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        update(category){
            let vm = this;
            vm.isloading = true;
            axios.put('/masterdata/categories/'+vm.taxonomy.slug+'/'+category+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    vm.isloading = false;
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               vm.isloading = false;
            });
        }
    },
    watch: {
        current(){
            console.log(this.current);
            if(this.current){
                this.edit(this.current);
            }
        }
    },
    mounted(){

    }
}
</script>
