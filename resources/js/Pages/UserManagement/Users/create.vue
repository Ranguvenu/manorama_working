<template>
    <div>
        <ButtonRegular size="sm" v-on:click="open_modal" v-if="type.meta.add">{{ type.meta.new }}</ButtonRegular>
        <SideModal :show="show" max-width="4xl" @close="close_modal">
            <template #header>
                <div class="text-lg"><span v-if="current">Edit</span><span v-else>Add</span> {{ type.meta.singular }}</div>
            </template>
            <div class="mx-2">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="sm:col-span-6">
                        <InputLabel for="name">User Name <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.name"
                            :disabled="current ? true : false"
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]"/>
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="email">Email <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 w-full"
                            v-model="form.email"
                            :disabled="current ? true : false"
                            autofocus
                            autocomplete="email"
                        />
                        <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]"/>
                    </div>
                    <div class="sm:col-span-6" v-if="!current">
                        <InputLabel for="password">Password <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 w-full"
                            v-model="form.password"
                            autofocus
                            autocomplete="password"
                        />
                        <InputError class="mt-2" v-if="errors && errors.password" :message="errors.password[0]"/>
                    </div>
                    <div class="sm:col-span-6" v-if="!current">
                        <InputLabel for="password_confirmation">Confirm Password <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="password_confirmation"
                            type="Password"
                            class="mt-1 w-full"
                            v-model="form.password_confirmation"
                            autofocus
                            autocomplete="password_confirmation"
                        />
                        <InputError class="mt-2" v-if="errors && errors.password_confirmation" :message="errors.password_confirmation[0]"/>
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="firstname">First Name <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="firstname"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.firstname"
                            autofocus
                            autocomplete="firstname"
                        />
                        <InputError class="mt-2" v-if="errors && errors.firstname" :message="errors.firstname[0]"/>
                    </div>
                    <div class="sm:col-span-6">
                        <InputLabel for="lastname">Last Name <span class="text-red-600">*</span></InputLabel>
                        <TextInput
                            id="lastname"
                            type="text"
                            class="mt-1 w-full"
                            v-model="form.lastname"
                            autofocus
                            autocomplete="lastname"
                        />
                        <InputError class="mt-2" v-if="errors && errors.lastname" :message="errors.lastname[0]"/>
                    </div>
                    <div class="sm:col-span-12">
                        <InputLabel for="phone">Phone Number <span class="text-red-600">*</span></InputLabel>
                        <PhoneNumber
                            id="phone"
                            class="mt-1 w-full"
                            v-model="form.phone"
                            autofocus
                            autocomplete="phone"
                        />
                        <InputError class="mt-2" v-if="errors && errors['phone.code']" :message="errors['phone.code'][0]"/>
                        <InputError class="mt-2" v-if="errors && errors['phone.number']" :message="errors['phone.number'][0]"/>
                    </div>
                    <div class="sm:col-span-12" v-if="datainitialized">
                        <InputLabel for="role">Role <span class="text-red-600">*</span></InputLabel>
                        <MultiSelect class="mt-2" v-model="form.roles" returns="name" :options="data.roles" label="fullname" :multiple="true"  :disabled="type.slug == 'subscribers' ? true : false"/>
                        <InputError class="mt-2" v-if="errors && errors.roles" :message="errors.roles[0]"/>
                    </div>
                </div>
                <div v-for="(field, index) in fields" :key="index" v-if="datainitialized">
                    <component v-bind:is="field" :options="get_options(data.others, field)" :value="form.metadata[field]" v-model="form.metadata[field]"></component>
                </div>
            </div>
            <template #footer>
                <ButtonRegular size="sm" color="default"  v-on:click="close_modal">Close</ButtonRegular>
                <ButtonRegular size="sm" color="primary"  v-if="current" v-on:click="update(current)">Update</ButtonRegular>
                <ButtonRegular size="sm" color="primary"  v-if="!current" v-on:click="store">Create</ButtonRegular>
            </template>
        </SideModal>
    </div>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PhoneNumber from '@/Components/PhoneNumber.vue';
import TextArea from '@/Components/TextArea.vue';
import Checkbox from '@/Components/Checkbox.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import ButtonRegular from "@/Components/Button.vue";
import ButtonOutline from '@/Components/ButtonOutline.vue';

import ProfileImage from './fields/profileimage.vue';
import CategoryField from './fields/categories.vue';
import Biography from './fields/biography.vue';
import Address from './fields/address.vue';
import Profile from './fields/profile.vue';
import Logo from './fields/logo.vue';
import IsFeatured from './fields/isfeatured.vue';
import Sources from './fields/sources.vue';
import Subjects from './fields/subjects.vue';

export default{
    components:{
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        PhoneNumber,
        TextArea,
        Checkbox,
        MultiSelect,
        ButtonRegular,
        ButtonOutline,
        "profileimage": ProfileImage,
        "categories": CategoryField,
        "biography": Biography,
        "address": Address,
        "profile": Profile,
        'isfeatured': IsFeatured,
        'sources': Sources,
        'logo': Logo,
        'subjects': Subjects,
    },
    props:{
        current: {
            type: Number,
            required: true
        },
        type:{
            type: Object,
            required: true
        }
    },
    data(){
        return{
            show: false,
            form: this.initialize(),
            errors: [],
            data: {
                roles: [],
                others: {

                }
            },
            metafields: {
                moderator: ['categories'],
                'blog-writer': ['profile', 'profileimage'],
                'expert': ['categories', 'biography', 'address', 'logo', 'isfeatured', 'profile', 'profileimage'],
                'test-center-expert': ['sources'],
                'creator': ['sources'],
                'questioncreator': ['sources'],
                'administrator': ['sources'],
                'content-lead': ['sources'],
                'contentcreator': ['sources'],
                'moderator': ['sources'],
                'questionreviewer': ['sources'],
                'contentlead': ['sources'],
                'ybu': ['sources'],
                'reviewer': ['sources'],
            },
            fields: [],
            datainitialized: false
        }
    },
    methods: {
        initialize(){
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                firstname: '',
                lastname: '',
                phone: {
                    number: '',
                    code: '+91'
                },
                roles: [],
                metadata: {
                    sources: [],
                    categories: [],
                    biography: '',
                    address: '',
                    logo: '',
                    profileimage: '',
                    isfeatured: '',
                    profile: '',
                },
                profile: '',
            }
        },
        create(){
            let vm = this;
            axios.get(route('users.type.create', {category: vm.type.slug})).then(response => {
                vm.data = response.data;
                vm.datainitialized = true;
            }).catch(error => {

            });
        },
        store(){
            let vm = this;
            axios.post(route('users.type.store', {category: vm.type.slug}), vm.form).then(response => {
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
                this.$toast.error('Failed to Create Internal Staff', {                        
                    position: 'bottom-right'
                });
            });
        },
        edit(user){
            let vm = this;
            axios.get(route('users.type.edit', {category: vm.type.slug, user: user})).then(response => {
                this.form = response.data;
                this.show = true;
            }).catch(error => {

            });
        },
        update(user){   
            let vm = this;            
            axios.put(route('users.type.update', {category: vm.type.slug, user: user}), vm.form).then(response => {
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
                this.$toast.error('Failed to Update Internal Staff', {                        
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
        },
        get_options(options, field){
            return (options && options[field]) ? options[field] : [];
        },
        extract_fields(roles){
            let fields = [];
            roles.forEach((role, index) => {
                let meta = this.metafields[role];
                if(meta && Array.isArray(meta)){
                    meta.forEach( (value, key) => {
                        fields.push(value);
                    });
                }
            });

            return [...new Set(fields)];
        }
    },
    watch: {
        'form.roles'(){
            this.fields = this.extract_fields(this.form.roles);
        },
        current(){
            if(this.current){
                this.create();
                this.edit(this.current);
            }
        }
    },
    mounted(){
       this.fields = this.extract_fields(this.form.roles);
    }
}
</script>
