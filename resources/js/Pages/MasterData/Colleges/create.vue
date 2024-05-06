<template>
    <div>
        <Button size="sm" v-if="$has_capability('create-college')" v-on:click="open_modal">Add College</Button>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Update</span><span v-else>Add</span> College</div>
            </template>
            <div class="mx-2">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 border-2 p-3">
                    <div class="sm:col-span-12">
                        <InputLabel for="name">College/Institute Name <span class="text-red-400">*</span></InputLabel>
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

                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="established_year">Established Year <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="established_year"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.established_year"
                            required
                            autofocus
                            autocomplete="established_year"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        />
                        <InputError class="mt-2" v-if="errors && errors.established_year" :message="errors.established_year[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="type">Type of College <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="type"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.type"
                            required
                            autofocus
                            autocomplete="type"
                        />
                        <InputError class="mt-2" v-if="errors && errors.type" :message="errors.type[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-12">
                        <InputLabel for="address">Address <span class="text-red-400">*</span></InputLabel>
                        <TextArea
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
                            autofocus
                            autocomplete="address"
                        />
                        <InputError class="mt-2" v-if="errors && errors.address" :message="errors.address[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="country">Country <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.country"
                            required
                            autofocus
                            autocomplete="country"
                        />
                        <InputError class="mt-2" v-if="errors && errors.country" :message="errors.country[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="state">State <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                            required
                            autofocus
                            autocomplete="state"
                        />
                        <InputError class="mt-2" v-if="errors && errors.state" :message="errors.state[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="district">District <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="district"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.district"
                            required
                            autofocus
                            autocomplete="district"
                        />
                        <InputError class="mt-2" v-if="errors && errors.district" :message="errors.district[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="pincode">Pin Code <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="pincode"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.pincode"
                            required
                            autofocus
                            autocomplete="pincode"
                        />
                        <InputError class="mt-2" v-if="errors && errors.pincode" :message="errors.pincode[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="contact_person" value="Contact Person" />
                        <TextInput
                            id="contact_person"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.contact_person"
                            autofocus
                            autocomplete="contact_person"
                        />
                        <InputError class="mt-2" v-if="errors && errors.contact_person" :message="errors.contact_person[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="phone" value="Phone" />
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

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="fax" value="Fax" />
                        <TextInput
                            id="fax"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.fax"
                            required
                            autofocus
                            autocomplete="fax"
                        />
                        <InputError class="mt-2" v-if="errors && errors.fax" :message="errors.fax[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="email">Email <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="email"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="email"
                        />
                        <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="website">Website <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="website"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.website"
                            required
                            autofocus
                            autocomplete="website"
                        />
                        <InputError class="mt-2" v-if="errors && errors.website" :message="errors.website[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="student_intake" value="Student intake/Year" />
                        <TextInput
                            id="student_intake"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.student_intake"
                            required
                            autofocus
                            autocomplete="student_intake"
                        />
                        <InputError class="mt-2" v-if="errors && errors.student_intake" :message="errors.student_intake[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <InputLabel for="nat_rank" value="NAT ranking" />
                        <TextInput
                            id="nat_rank"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.nat_rank"
                            required
                            autofocus
                            autocomplete="nat_rank"
                        />
                        <InputError class="mt-2" v-if="errors && errors.nat_rank" :message="errors.nat_rank[0]" />
                    </div>

                    <div class="mt-3  sm:col-span-6">
                        <label class="flex items-center">
                            <Checkbox name="is_deemed" v-model:checked="form.is_deemed" />
                            <span class="ml-2 text-sm text-gray-600">Is deemed</span>
                        </label>
                        <InputError class="mt-2" v-if="errors && errors.is_deemed" :message="errors.is_deemed[0]" />
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 border-2 p-3 mt-2">
                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="name_of_principal" value="Name of Principal" />
                        <TextInput
                            id="name_of_principal"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name_of_principal"
                            required
                            autofocus
                            autocomplete="name_of_principal"
                        />
                        <InputError class="mt-2" v-if="errors && errors.name_of_principal" :message="errors.name_of_principal[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="contact_no_of_principal" value="Contact Number of Principal"/>
                        <TextInput
                            id="contact_no_of_principal"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.contact_no_of_principal"
                            required
                            autofocus
                            autocomplete="contact_no_of_principal"
                        />
                        <InputError class="mt-2" v-if="errors && errors.contact_no_of_principal" :message="errors.contact_no_of_principal[0]"/>
                    </div>

                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="email_of_principal" value="Email Id of Principal" />
                        <TextInput
                            id="email_of_principal"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.email_of_principal"
                            required
                            autofocus
                            autocomplete="email_of_principal"
                        />
                        <InputError class="mt-2" v-if="errors && errors.email_of_principal" :message="errors.email_of_principal[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-6">
                        <InputLabel for="admin">College admin <span class="text-red-400">*</span></InputLabel>
                        <TextInput
                            id="admin"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.admin"
                            required
                            autofocus
                            autocomplete="admin"
                        />
                        <InputError class="mt-2" v-if="errors && errors.admin" :message="errors.admin[0]" />
                    </div>
                </div>
                <div class="border-2 p-2 mt-2">
                    <div class="mt-3">
                        <InputLabel for="short_description" value="Short Description" />
                        <CkEditor
                            id="short_description"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.short_description"
                            required
                            autofocus
                            autocomplete="short_description"
                        />
                        <InputError class="mt-2" v-if="errors && errors.short_description" :message="errors.short_description[0]" />
                    </div>

                    <div class="mt-3">
                        <InputLabel for="why_join" value="Why Join?" />
                        <CkEditor
                            id="why_join"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.why_join"
                            required
                            autofocus
                            autocomplete="why_join"
                        />
                        <InputError class="mt-2" v-if="errors && errors.why_join" :message="errors.why_join[0]" />
                    </div>

                    <div class="mt-3">
                        <InputLabel for="high_light_text" value="High Light Text" />
                        <TextArea
                            id="high_light_text"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.high_light_text"
                            required
                            autofocus
                            autocomplete="high_light_text"
                        />
                        <InputError class="mt-2" v-if="errors && errors.high_light_text" :message="errors.high_light_text[0]" />
                    </div>

                    <div class="mt-3">
                        <InputLabel for="similar_location" value="Similar Names of Location"/>
                        <TextArea
                            id="similar_location"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.similar_location"
                            required
                            autofocus
                            autocomplete="similar_location"
                        />
                        <InputError class="mt-2" v-if="errors && errors.similar_location" :message="errors.similar_location[0]" />
                    </div>

                    <div class="mt-3">
                        <InputLabel for="similar_college" value="Similar Names of College" />
                        <TextArea
                            id="similar_college"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.similar_college"
                            required
                            autofocus
                            autocomplete="similar_college"
                        />
                        <InputError class="mt-2" v-if="errors && errors.similar_college" :message="errors.similar_college[0]" />
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 mt-2 p-3 border-2">
                    <div class="mt-3 sm:col-span-4">
                        <InputLabel class="mb-3" for="logo" value="Upload Logo" />
                        <MediaButton accepts="png,jpeg,jpg,svg,webp" component="colleges" name="Upload Logo" :multiple="false" return_type="id" v-model="form.logo_id" />
                        <small class="text-gray-600">Note: Logo should be in .png, .jpeg, .jpg, .svg or .webp format.</small>
                        <InputError class="mt-2" v-if="errors && errors.logo_id" :message="errors.logo_id[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-4">
                        <InputLabel class="mb-3" for="brochure" value="Upload Brochure" />
                        <MediaButton accepts="pdf" component="colleges" name="Upload Brochure" :multiple="false" return_type="id" v-model="form.brochure_id"/>
                        <small class="text-gray-600">Note: Brochure should be in .pdf format.</small>
                        <InputError class="mt-2" v-if="errors && errors.brochure_id" :message="errors.brochure_id[0]" />
                    </div>

                    <div class="mt-3 sm:col-span-4">
                        <InputLabel class="mb-3" for="application_form" value="Upload Application Form" />
                        <MediaButton accepts="pdf" component="colleges" name="Upload Application Form" :multiple="false" return_type="id" v-model="form.application_form_id"/>
                        <small class="text-gray-600">Note: Application should be in .pdf format.</small>
                        <InputError class="mt-2" v-if="errors && errors.application_form_id" :message="errors.application_form_id[0]" />
                    </div>
                </div>
                <div class="border-2 p-2 mt-2">
                    <div class="py-1 text-lg font-semibold">College Facilities</div>
                    <div class="border-b-2 mb-3"></div>
                    <table class="table-auto border-0">
                        <tbody>
                            <tr class="border-0 w-full" v-for="facility in form.facilities" key="facility.slug">
                                <td class="border-0">{{ facility.name }}</td>
                                <td class="border-0">
                                    <Checkbox v-model:checked="facility.is_available" :value="facility.is_available"/>
                                    <input type="hidden" v-model="facility.slug"/>
                                    <input type="hidden" v-model="facility.name"/>
                                </td>
                                <td class="border-0">
                                    <TextInput
                                        id="facility.name"
                                        name="description"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="facility.description"
                                        autofocus
                                        autocomplete="facility.description"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <template #footer>
                <Button size="sm" color="default"  v-on:click="close_modal">Close</Button>
                <Button size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update College</Button>
                <Button size="sm" color="primary"  v-if="!current" v-on:click="store">Create College</Button>
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
import CkEditor from "@/Components/CkEditor.vue";
import MediaButton from "@/Components/MediaButton.vue"; 
import { Link, useForm, usePage } from "@inertiajs/vue3";

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
        MediaButton,
        CkEditor
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
                established_year: '',
                type: '',
                address: '',
                country: '',
                state: '',
                district: '',
                pincode: '',
                contact_person: '',
                phone: '',
                fax: '',
                email: '',
                website: '',
                student_intake: '',
                nat_rank: '',
                is_deemed: 0,
                name_of_principal: '',
                contact_no_of_principal: '',
                email_of_principal: '',
                admin: '',
                short_description: '',
                why_join: '',
                high_light_text: '',
                similar_location: '',
                similar_college: '',
                logo_id: '',
                brochure_id: '',
                application_form_id: '',
                facilities: [],
            }
        },
        create(){
            let vm = this;
            axios.get('/masterdata/colleges/create').then(response => {
                vm.form.facilities = response.data.facilities;
            }).catch(error => {

            });
        },
        edit(college){
            let vm = this;
            axios.get('/masterdata/colleges/'+college+'/edit').then(response => {
                vm.form = response.data.data;
                this.show = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post('/masterdata/colleges/store', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    });
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
                this.$toast.error('Failed to Create College', {                        
                                    position: 'bottom-right'                   
                                });
            });
        },
        update(college){
            let vm = this;
            axios.put('/masterdata/colleges/'+college+'/update', vm.form).then(response => {
                if(response.data.success){
                    vm.close_modal();
                    vm.$emit('refresh');
                    this.$toast.success(response.data.message, {                        
                        position: 'bottom-right'                   
                    })
                }
            }).catch(error => {
               vm.errors = error.response.data.errors;
               this.$toast.error('Failed to Update College', {                        
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
                this.edit(this.current);
            }
        }
    },
    mounted(){
        
    }
}
</script>
