<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-faq')" v-on:click="open_modal">Add Faq</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Faq</div>
            </template>
            <div class="mx-2">
                <div class="mt-2">
                    <InputLabel for="title">Title <span class = "text-red-400">*</span></InputLabel>
                    <TextInput
                        id="title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        required
                        autofocus
                        autocomplete="title"
                    />                
                    <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]" />
                </div>
                <div class="mt-3" v-if="isinitialized">
					<InputLabel for="category">Category <span class = "text-red-400">*</span></InputLabel>		
                    <MultiSelect class="mt-2" v-model="form.category_id" returns="id" :options="data.categories" label="name" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.category_id" :message="errors.category_id[0]" />
               </div>
               <div class="mt-3">
					<InputLabel class="mb-2" for="description">Description <span class = "text-red-400">*</span></InputLabel>	
                    <CkEditor 
                        id="description"
                        type="text"
                        class="w-full"
                        v-model="form.description"
                        required
                        autofocus
                        autocomplete="form.description"/>                    
                    <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />                        
                </div>
                <div class="mt-3">
                    <label class="flex items-center">
                        <Checkbox name="status" v-model:checked="form.status" />
                        <span class="ml-2 text-sm text-gray-600">Is Active</span>
                    </label>                   
                    <InputError class="mt-2" v-if="errors && errors.status" :message="errors.status[0]" /> 
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Faq</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Faq</Button>
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
import Button from "@/Components/Button.vue";
import CkEditor from '@/Components/CkEditor.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
export default{
    components:{
        SideModal,
        CkEditor,       
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        Button,
        ButtonOutline,
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
            data: {
                categories: []
            },
            isinitialized: false,
        }
    },
    methods:{
        initialize(){
            return{
                title: '',
                category_id: '',
                description: '',
                status: 0,           
            }
        },    
        edit(faq){
            let vm = this;
            axios.get('/masterdata/faq/'+faq+'/edit').then(response => {
                vm.form = response.data.data;
                vm.show = true;
            }).catch(error => {

            });
        },
        create(){
            let vm = this;
            axios.get('/masterdata/faq/create').then(response => {
                vm.data = response.data;
                vm.isinitialized = true;
            }).catch(error =>{

            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/faq/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        update(faq){
            let vm = this;
            axios.put('/masterdata/faq/'+faq+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
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
