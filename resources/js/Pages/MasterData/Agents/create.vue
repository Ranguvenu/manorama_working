<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-field-agent')" v-on:click="open_modal">Add Field Agent</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Agent</div>
            </template>
            <div class="mx-2">
                <div>
                    <InputLabel for="name">Name <span class="text-red-400">*</span></InputLabel>
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
                    <InputLabel for="code">Code <span class="text-red-400">*</span></InputLabel>
                    <TextInput
                        id="code"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.code"
                        required
                        autofocus
                        autocomplete="code"
                        v-bind:disabled="current"
                        v-bind:enabled="!current"
                        />
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="location" value="Location" />
                    <TextInput
                        id="location"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.location"
                        autofocus
                        autocomplete="location"
                        />
                    <InputError class="mt-2" v-if="errors && errors.location" :message="errors.location[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="locality" value="Locality" />
                    <TextInput
                        id="locality"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.locality"
                        autofocus
                        autocomplete="locality"
                        />
                    <InputError class="mt-2" v-if="errors && errors.locality" :message="errors.locality[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Agent</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Agent</Button>
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
export default{
    components:{
        SideModal,        
        InputError,
        InputLabel,
        TextInput,
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
                location: '',
                locality: '',
            }
        },
        edit(agent){
            let vm = this;
            axios.get('/masterdata/agents/'+agent+'/edit').then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/agents/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                      
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Field Agent', {                   
                    position: 'bottom-right'                   
                });
            });
        },
        update(agent){
            let vm = this;
            axios.put('/masterdata/agents/'+agent+'/update', vm.form).then(response => {
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
