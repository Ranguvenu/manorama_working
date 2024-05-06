<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-school')" v-on:click="open_modal">Add School</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> School</div>
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
                    <InputLabel for="code">Short Name</InputLabel> 
                    <TextInput
                        id="code"
                        type="text"
                        class="w-full  mt-1"
                        v-model="form.code"
                        autofocus
                        autocomplete="code"
                        v-bind:disabled="current && code !=null ? true : false"
                        v-bind:enabled="!current && code == null ? true : false"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code"  :message="errors.code[0]"/>
                </div>
                <div class="mt-3">
                    <InputLabel for="location">Location <span class = "text-red-600">*</span></InputLabel> 
                    <TextInput
                        id="location"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.location"
                        required
                        autofocus
                        autocomplete="location"/>
                    <InputError class="mt-2" v-if="errors && errors.location"  :message="errors.location[0]"/>
                </div>
                <div class="mt-3">
                    <InputLabel for="district">District <span class = "text-red-600">*</span></InputLabel>
                    <TextInput
                        id="district"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.district"
                        required
                        autofocus
                        autocomplete="district"
                    />
                    <InputError class="mt-2" v-if="errors && errors.district"  :message="errors.district[0]" />
                </div>

                <div class="mt-3">
                    <InputLabel for="state">State <span class = "text-red-600">*</span></InputLabel>                   
                    <TextInput
                        id="state"
                        type="text"
                        class="w-full mt-1"
                        v-model="form.state"
                        required
                        autofocus
                        autocomplete="state"
                    />
                    <InputError class="mt-2" v-if="errors && errors.state" :message="errors.state[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="country">Country<span class = "text-red-600">*</span></InputLabel>                   
                    <TextInput
                        id="state"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.country"
                        required
                        autofocus
                        autocomplete="country"
                    />
                    <InputError class="mt-2" v-if="errors && errors.country" :message="errors.country[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="contact_details">Contact Details</InputLabel>
                    <TextInput
                        id="contact_details"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.contact_details"
                        required
                        autofocus
                        autocomplete="contact_details"
                    />
                    <InputError class="mt-2" v-if="errors && errors.contact_details" :message="errors.contact_details[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="address">Address</InputLabel>
                    <TextArea
                        id="address"
                        type="text"
                        class="mt-1 w-full"
                        v-model="form.address"
                        required
                        autofocus
                        autocomplete="address"
                    />
                    <InputError class="mt-2"  v-if="errors && errors.address" :message="errors.address[0]" />
                </div>
                <div class="mt-3">
                    <div class="flex items-center">
                        <label class="flex items-center w-2/3">
                            <Checkbox name="is_published" v-model:checked="form.is_published" />
                            <span class="ml-2 text-sm text-gray-600">Is Published</span>
                        </label>
                        <InputError class="mt-2" v-if="errors && errors.is_published" :message="errors.is_published[0]" />
                    </div>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update School</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create School</Button>
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
import ButtonOutline from '@/Components/ButtonOutline.vue';
export default{
    components:{
        SideModal,        
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
            errors: [],
            code: '',
        }
    },
    methods:{
        initialize(){
            return{
                name: '',
                code: '',
                location: '',
                district: '',
                state: '', 
                country: '',
                address: '',
                contact_details: '', 
                is_published: 0
            }
        },
        edit(school){
            let vm = this;
            axios.get('/masterdata/schools/'+school+'/edit').then(response => {
                this.form = response.data.data;
                this.code = response.data.data.code;
                this.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/schools/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'
                    });
 
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create School', {                        
                        position: 'bottom-right'
                    });
            });
        },
        update(school){
            let vm = this;
            axios.put('/masterdata/schools/'+school+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',
                    
                    });
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               this.$toast.error('Failed to Update School', {                        
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
