<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-blog-author')" v-on:click="open_modal">Add Author</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Author</div>
            </template>
            <div class="px-3">
                <div>
                    <InputLabel for="name">Name <span class = "text-red-400">*</span></InputLabel>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />                
                    <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-2" for="description">Bio<span class = "text-red-400">*</span></InputLabel>	
                    <CkEditor 
                        id="bio"
                        type="text"
                        class="w-full"
                        v-model="form.bio"
                        required
                        autofocus
                        autocomplete="description"               
                    
                    />                    
                    <InputError class="mt-2" v-if="errors && errors.bio" :message="errors.bio[0]"/>                        
                 </div>
                <div class="mt-3">
					<InputLabel for="image">Image <span class = "text-red-400">*</span></InputLabel>		
                    <MediaButton accepts="png,jpeg,jpg,svg,webp" component="author" name="Upload Image" :multiple="false" return_type="id" v-model="form.image"/>
                    <small class="text-gray-600">Note: Image should be in .png, .jpeg, .jpg, .svg or .webp format.</small> 
                    <InputError class="mt-2" v-if="errors && errors.image" :message="errors.image[0]" />
               </div>
                <div class="mt-3">
                    <label class="flex items-center">
                        <span class="ml-2 mr-2 text-sm text-gray-600">Student Editor</span>
                        <Checkbox name="status" v-model:checked="form.student_editor" />
                        
                    </label>                   
                    <InputError class="mt-2" v-if="errors && errors.student_editor" :message="errors.student_editor[0]" /> 
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Author</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Author</Button>
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
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MediaButton from "@/Components/MediaButton.vue"; 
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
        MediaButton
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
        }
    },
    methods:{
        initialize(){
            return{
                name: '',
                image: '',
                bio: '',
                student_editor: 0,           
            }
        },    
        edit(author){
            let vm = this;
            axios.get('/blog/author/'+author+'/edit').then(response => {
                vm.form = response.data.data;
                vm.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/blog/author/store', vm.form).then(response => {
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
                this.$toast.error('Failed to Create Author', {                        
                    position: 'bottom-right'
                });
            });
        },
        update(author){
            let vm = this;
            axios.put('/blog/author/'+author+'/update', vm.form).then(response => {
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
                this.$toast.error('Failed to  Update Author', {                        
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
                this.edit(this.current);
            }
        }
    },
    mounted(){
        
    }
}
</script>
