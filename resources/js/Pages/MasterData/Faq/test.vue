<template>
    <div class="bg-rose-50 text-white">
        <div class="font-semibold text text-gray-800 leading-tight">
            Registration Form
        </div>
        <div class="ms-1">
    
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3 ml-3 mr-3 border-2 p-3 bg-white">
                        <div class="sm:col-span-12  ">
                    <InputLabel for="basicdetails"
                         class = "font-semibold text text-gray-800 leading-tight text-size-200">1. Basic Details
                        </InputLabel
                    >
                
                    </div>
                <div class="sm:col-span-4">
                    <InputLabel for="name"
                        >Your Name
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        autofocus
                        autocomplete="host"
                    />
                    <InputError
                        class="mt-2"
                        v-if="errors && errors.name"
                        :message="errors.name[0]"
                    />
                </div>
                <div class="sm:col-span-4">
                    <InputLabel for="phone"
                        >Mobile Number
                        <span class="text-red-400">*</span></InputLabel
                    >
                    <PhoneNumber
                    id="phone"
                    class="text-black border-neutral-200 block w-full mt-2"
                    v-model="form.phone"
                    autofocus
                    autocomplete="phone"
                />
                <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]" />
                <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]" />
                </div>
                <div class="sm:col-span-4">
                    <InputLabel for="email"
                        >Email Id <span class="text-red-400">*</span></InputLabel
                    >
                    <TextInput
                        id="email"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        autofocus
                    />
                    <InputError
                        class="mt-1"
                        v-if="errors && errors.email"
                        :message="errors.email[0]"
                    />
                    </div>


            </div>
            </div>

          
    
    <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3 ml-3 mr-3 border-2 p-3 bg-white">
                <div class="sm:col-span-12  ">
            <InputLabel for="theme_facebook"
                 class = "font-semibold text text-gray-800 leading-tight text-size-200">2. School Details
                </InputLabel
            >
            </div>
        <div class="sm:col-span-4">
            <InputLabel for="school"
                >School
                <span class="text-red-400">*</span></InputLabel
            >
            <TextInput
                id="school"
                type="text"
                class="mt-1 block w-full"
                v-model="form.school"
                autofocus
                autocomplete="host"
            />
            <InputError
                class="mt-2"
                v-if="errors && errors.school"
                :message="errors.school[0]"
            />
        </div>
        <div class="sm:col-span-4">
            <InputLabel for="district"
                >District
                <span class="text-red-400">*</span></InputLabel
            >
            <TextInput
                id="district"
                type="text"
                class="mt-1 block w-full"
                v-model="form.district"
                autofocus
                autocomplete="host"
            />
            <InputError
                class="mt-2"
                v-if="errors && errors.district"
                :message="errors.district[0]"
            />
        </div>
        <div class="sm:col-span-4">
            <InputLabel for="locality"
                >Locality <span class="text-red-400">*</span></InputLabel
            >
            <TextInput
                id="locality"
                type="text"
                class="mt-1 block w-full"
                v-model="form.locality"
                autofocus
            />
            <InputError
                class="mt-1"
                v-if="errors && errors.locality"
                :message="errors.locality[0]"
            />
            </div>
            <div class="sm:col-span-4">
            <InputLabel for="pincode"
                >Pincode <span class="text-red-400">*</span></InputLabel
            >
            <TextInput
                id="pincode"
                type="text"
                class="mt-1 block w-full"
                v-model="form.pincode"
                autofocus
            />
            <InputError
                class="mt-1"
                v-if="errors && errors.pincode"
                :message="errors.pincode[0]"
            />
            </div>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 mt-3 ml-3 mr-3 border-2 p-3 bg-white">
                <div class="sm:col-span-12  ">
            <InputLabel for="uploaddocuments"
                 class = "font-semibold text text-gray-800 leading-tight text-size-200">3. Upload Documents
                </InputLabel
            >
            </div>
        <div class="sm:col-span-4">
            <InputLabel for="video">Upload Video</InputLabel>
                    <MediaButton class="mt-1" accepts="mp4" component="guruvandhanam" name="Upload Video"
                        :multiple="false" return_type="url" v-model="form.video" />
                    <small class="text-gray-600">Note: Video should be mp4 format.</small>  
                    <InputError class="mt-1" v-if="errors && errors.video" :message="errors.video[0]" />
        </div>
        <div class="sm:col-span-4">
            <InputLabel for="videourl"
                >Upload Video URL
                <span class="text-red-400">*</span></InputLabel
            >
            <TextInput
                id="videourl"
                type="text"
                class="mt-1 block w-full"
                v-model="form.videourl"
                autofocus
                autocomplete="host"
            />
            <InputError
                class="mt-2"
                v-if="errors && errors.videourl"
                :message="errors.videourl[0]"
            />
        </div>
        <div class="sm:col-span-4">
            <InputLabel for="video">Upload Certificate From Principal</InputLabel>
                    <MediaButton class="mt-1" accepts="pdf" component="guruvandhanam" name="Upload Certificate"
                        :multiple="false" return_type="url" v-model="form.certificate" />
                    <small class="text-gray-600">Note: Certificate should be pdf format.</small>  
                    <InputError class="mt-1" v-if="errors && errors.certificate" :message="errors.certificate[0]" />

            </div>
            </div>
          <Button size="sm" color="primary"   v-on:click="store">Submit</Button>
       </div>
</template>
<script>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ButtonRegular from "@/Components/Button.vue";
import MediaButton from "@/Components/MediaButton.vue";
import TextArea from "@/Components/TextArea.vue";
import PhoneNumber from '@/Components/PhoneNumber.vue';
import Button from "@/Components/Button.vue";
export default {
    components: {
        InputLabel,
        TextInput,
        InputError,
        ButtonRegular,
        MediaButton,
        TextArea,
        PhoneNumber,
        Button
    },
    data(){
        return{
            form: this.initialize(),
                 errors: [],
        }
    },
    methods:{
        initialize(){
            return {
                name: '',
                email: '',
                phone: {
                    code: '+91',
                    number: ''
                },
                school: '',
                district: '',
                locality: '',
                pincode: '',
                video: '',
                videourl: '',
                certificate: ''
            }
        },
        store(){
            let vm = this;
            axios.post('/guruvandanam/store', vm.form).then(response => {
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

        }
        
    },
    mounted(){

    }
}
</script>
