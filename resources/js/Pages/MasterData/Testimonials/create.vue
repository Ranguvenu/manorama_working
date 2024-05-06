<template>
	<div>
		<Button size="sm" v-if="$has_capability('create-testimonial')" v-on:click="open_modal">Add Testimonial</Button> 
        <SideModal :show="show" max-width="2xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> Testimonial</div>
            </template>
            <div class="mx-2">
                <div>
                    <InputLabel for="profile">Profile <span class = "text-red-400">*</span></InputLabel>
                    <TextInput
                        id="profile"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.profile"
                        required
                        autofocus
                        autocomplete="profile"
                    />
                    <InputError class="mt-2" v-if="errors && errors.profile" :message="errors.profile[0]" />
                </div>
                <div class="mt-3">
                    <InputLabel class="mb-3" for="avatar_id">Profile Image</InputLabel>
                    <MediaButton component="testimonials" name="Choose file" accepts="png,jpeg,jpg,svg,webp" :multiple="false" return_type="id" v-model="form.avatar_id"/>
                    <InputError class="mt-2" v-if="errors && errors.avatar_id" :message="errors.avatar_id[0]" />
                </div>
                <div class="mt-3">
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
                <div class="mt-3">
                    <InputLabel for="testimonial_type"
                        >Testimonial Type <span class="text-red-400">*</span></InputLabel
                    >
                    <select
                        style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                        id="testimonial_type"
                        class="mt-1 block w-full border-0.5"
                        v-model="form.testimonial_type"
                    >
                        <option value="0">Select</option>
                        <option value="1">Text</option>
                        <option value="2">Video</option>
                    </select>
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.testimonial_type"
                        :message="errors.testimonial_type[0]"
                    />
                </div>
                <div class="mt-3" v-if="form.testimonial_type == 1">
                    <InputLabel for="testimonial">Testimonial <span class="text-red-400">*</span></InputLabel>
                    <CkEditor v-model="form.testimonial" />
                    <InputError class="mt-2" v-if="errors && errors.testimonial" :message="errors.testimonial[0]" />
                </div>
                <div class="mt-3" v-else-if="form.testimonial_type == 2">
                <InputLabel for="testimonial">Testimonial <span class="text-red-400">*</span></InputLabel>
                <MediaButton accepts="mp4" component="testimonial" name="Upload Video"
                        :multiple="false" return_type="url" v-model="form.testimonial" />                   
                    <InputError class="mt-2" v-if="errors && errors.testimonial" :message="errors.testimonial[0]" />
            </div>
                
                <div class="mt-3">
                    <InputLabel for="product_id">Product <span class="text-red-400">*</span></InputLabel>
                    <MultiSelect class="mt-2" v-model="form.product_id" returns="id" :options="data.packages" label="title" :multiple="false"/>
                    <InputError class="mt-2" v-if="errors && errors.product_id" :message="errors.product_id[0]" />
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update Testimonial</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create Testimonial</Button>
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
import MultiSelect from '@/Components/MultiSelect.vue';
import CkEditor from '@/Components/CkEditor.vue';
import MediaButton from '@/Components/MediaButton.vue';

export default{
	components:{
		SideModal,        
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Checkbox,
        Button,
        ButtonOutline,
        MultiSelect,
        CkEditor,
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
            data: {
                packages: []
            }
        }
    },
	methods:{
		initialize(){
			return{
				profile: '',
                avatar_id: '',
				name: '',
				title: '',
                testimonial_type: '',
				testimonial: '',
				product_id: ''

			}
		},
        create(){
            let vm = this;
            axios.get('/masterdata/testimonials/create').then(response => {
                vm.data = response.data;
            }).catch(error =>{

            });
        },
		edit(testimonial){
            let vm = this;
            axios.get('/masterdata/testimonials/'+testimonial+'/edit').then(response => {
                this.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
		store(){
            let vm = this;
            axios.post('/masterdata/testimonials/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',                   
                    });

                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create Testimonials', {                        
                        position: 'bottom-right'
                    });
            });
        },
		update(testimonial){
            let vm = this;
            axios.put('/masterdata/testimonials/'+testimonial+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right',                   
                    });
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               this.$toast.error('Failed to Update Testimonials', {                        
                        position: 'bottom-right'
                    });
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
