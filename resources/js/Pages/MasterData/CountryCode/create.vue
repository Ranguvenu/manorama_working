<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-countrycode')" v-on:click="open_modal">Add country code</Button>
        <Modal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> country code</div>
            </template>
            <div class="px-3">
                <div class="mt-3">
                    <InputLabel for="name">Name <span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="name"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="name">Code <span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="code"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.code"
                        required
                        autofocus
                        autocomplete="code"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]" />
                </div>

            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update country code</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create country code</Button>
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
export default{
    components:{
        Modal,        
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        Button,
        ButtonOutline
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
            errors: []
        }
    },
    methods:{
        initialize(){
            return{
                name: '',
                code: '',
            }
        },
        edit(countrycode){
            let vm = this;
            axios.get('/masterdata/countrycode/'+countrycode+'/edit').then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {
                
            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/countrycode/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'
                    });
 
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create countrycode', {                        
                        position: 'bottom-right'
                    });
            });
        },
        update(countrycode){
            let vm = this;
            axios.put('/masterdata/countrycode/'+countrycode+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',
                    
                    });
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               this.$toast.error('Failed to Update countrycode', {                        
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
