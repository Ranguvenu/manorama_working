<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-universities')" v-on:click="open_modal">Add University</Button>
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Update</span><span v-else>Add</span> University</div>
            </template>
            <div class="px-3">
                <div class="mt-3">
					<InputLabel for="name">University Name <span class = "text-red-600">*</span></InputLabel> 
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
                <div class="mt-3" >
                    <InputLabel for="code">Code</InputLabel>
                    <TextInput
                        id="code"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.code"
                        autofocus
                        autocomplete="code"
                        v-bind:disabled="current && code !=null ? true : false"
                        v-bind:enabled="!current && code == null ? true : false"
                    />
                    <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="established_on">Established On</InputLabel>      
                    <TextInput
                        id="established_on"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.established_on"
                        autofocus
                        autocomplete="date"
                    />
                    <InputError class="mt-2" v-if="errors && errors.established_on" :message="errors.established_on[0]" />
                </div>
                <div class="mt-3">                
                    <InputLabel for="address">Address</InputLabel>
                    <TextArea
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address"
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" v-if="errors && errors.address" :message="errors.address[0]" />       
                </div>
                <div class="mt-3">
                    <InputLabel for="pincode">Pin Code</InputLabel>               
                    <TextInput
                        id="pincode"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.pincode"
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" v-if="errors && errors.pincode" :message="errors.pincode[0]" />   
                </div>
                <div class="mt-3">
                    <InputLabel for="location">Location</InputLabel>
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
                    <InputLabel for="state">State</InputLabel>    
                    <TextInput
                        id="state"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.state"
                        autofocus
                        autocomplete="state"
                    />
                    <InputError class="mt-2" v-if="errors && errors.state" :message="errors.state[0]" />      
                </div>
                <div class="mt-3"> 
                    <InputLabel for="country">Country</InputLabel>          
                    <TextInput
                        id="country"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.country"
                        autofocus
                        autocomplete="country"
                    />
                    <InputError class="mt-2" v-if="errors && errors.country" :message="errors.country[0]" />    
                </div>
                <div class="mt-3">
                    <InputLabel for="phone">Phone Number</InputLabel>
                    <TextInput
                        id="phone"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        autofocus
                        autocomplete="phone"
                    />
                    <InputError class="mt-2" v-if="errors && errors.phone" :message="errors.phone[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="email">Email</InputLabel>
                    <TextInput
                        id="email"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        autofocus
                        autocomplete="email"                      
                        :disabled  ="current  && email !=null ? true : false"
                        :enabled="!current && email == null ? true : false "
                    />
                    <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />  
                </div>
                <div class="mt-3">
                    <InputLabel for="fax">Fax Number</InputLabel> 
                    <TextInput
                        id="fax"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.fax"
                        autofocus
                        autocomplete="fax"
                    />
                    <InputError class="mt-2" v-if="errors && errors.fax" :message="errors.fax[0]" />    
                </div>
                <div class="mt-3">
                    <InputLabel for="website">Website</InputLabel>          
                    <TextInput
                        id="website"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.website"
                        autofocus
                        autocomplete="website"
                    />
                    <InputError class="mt-2" v-if="errors && errors.website" :message="errors.website[0]" />
                </div>
                <div class="mt-3">                
                    <InputLabel class="mb-3" for="logo" value="Upload Logo" />
                    <MediaButton accepts="png,jpeg,jpg,svg,webp" component="universities" name="Upload Logo" :multiple="false" return_type="id" v-model="form.logo_id"/>
                    <small class="text-gray-600">Note: Logo should be in .png, .jpeg, .jpg, .svg or .webp format.</small>					
                    <InputError class="mt-2" v-if="errors && errors.logo_id" :message="errors.logo_id[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel for="description">Description</InputLabel>        
                    <CkEditor 
                        id="description"
                        type="editor"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        autofocus
                        autocomplete="description"               
                    
                    /> 
                    <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]" />                  
                </div>          
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update University</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create University</Button>
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
import MediaButton from "@/Components/MediaButton.vue"; 
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
            code: '',
            email: ''
        }
    },
    methods:{
        initialize(){
            return{
                name: '',
                code: '',
                location: '',
                district: ''  ,
                state: '',
                country: '' ,
                address: '',            
                phone : '',
                established_on: '',
                pincode: '',
                phone: '',
                email: '',
                fax: '',
                website: '',
                logo_id: '',
                description:'',                    
            }
        },
        edit(university){           
            let vm = this;
            axios.get('/masterdata/universities/'+university+'/edit').then(response => {
                this.form = response.data.data;
                this.code = response.data.data.code;
                this.email = response.data.data.email;
                this.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/universities/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create University', {                        
                    position: 'bottom-right'
                });
            });
        },
        update(university){
            let vm = this;
            axios.put('/masterdata/universities/'+university+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Update University', {                        
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
