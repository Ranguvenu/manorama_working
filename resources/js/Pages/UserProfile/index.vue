<template>
    <Head title="Edit Profile"/>
    <WebsiteLayout>
        <div class="md:max-w-screen-2xl mx-auto md:px-16 px-4 py-8">
            <div class="flow-root mb-3">
                <div class="float-left">
                    <div class="text-zinc-800 text-xl font-semibold">Edit Profile</div>
                </div>
                <div class="float-right">
                    <a :href="route('integrations.sso.login')" class="text-blue-800 text-base">Back</a>
                </div>
            </div>
            <div class="flow-root">
                <div class="float-right">
                    <Button size="sm" color="secondary" v-on:click="resetpassword">Change Password</Button>
                    <Button size="sm" color="primary" v-on:click="update(form.id)">Save & Update</Button>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-3/5 pe-3 top-1/2 left-1/2 relative transform -translate-x-1/2">
                    <div class="flex items-center justify-center mb-3">
                        <div class="relative">
                            <img :src="avatarurl" class="object-cover border-primary border-4 rounded-full h-32 w-32">
                            <div class="absolute bottom-1 right-1 bg-white border-2 border-gray-500 w-8 h-8 rounded-full">
                                <label title="Click to upload" for="file-upload" class="cursor-pointer">
                                    <div class="absolute w-5 h-5 absolute bottom-1 right-1">
                                        <CameraIcon class="text-primary" />
                                    </div>
                                </label>
                                <input id="file-upload" name="file-upload" type="file" accept="image/*" @change="uploadFile" hidden="">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="font-semibold">Basic Information</div>
                    </div>
                    <div class="flex flex-wrap text-black text-sm ps-6 pt-6">
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="first_name">First Name</label>
                            <TextInput type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.firstname" />
                            <InputError class="mt-2" v-if='errors && errors.firstname' :message='errors.firstname[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="last_name">Last Name</label>
                            <TextInput type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.lastname" />
                            <InputError class="mt-2" v-if='errors && errors.lastname' :message='errors.lastname[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="dob">Date of Birth</label>
                            <TextInput id="dob" type="date" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.dob" required autofocus
                                autocomplete="date" />
                            <InputError class="mt-2" v-if="errors && errors.dob" :message="errors.dob[0]" />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="gender">Gender</label>
                            <div class="flex my-2">
                                <div>
                                    <input type="radio" v-model="form.gender" value="1">
                                    <label for="male" class="mx-2 text-gray-800">Male</label>
                                </div>
                                <div class="mx-3">
                                    <input type="radio" v-model="form.gender" value="2">
                                    <label for="female" class="mx-2 text-gray-800">Female</label>
                                </div>
                                <div>
                                    <input type="radio" v-model="form.gender" value="3">
                                    <label for="other" class="mx-2 text-gray-800">Other</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="font-semibold">Contact Information</div>
                    </div>
                    <div class="flex flex-wrap text-black text-sm ps-6 pt-6">
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="email">Email Address</label>
                            <TextInput type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.email" disabled="true" />
                            <InputError class="mt-2" v-if='errors && errors.email' :message='errors.email[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="phone">Phone Number</label>
                            <TextInput type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.phone_number" disabled="true" />
                            <InputError class="mt-2" v-if='errors && errors.phone_number' :message='errors.phone_number[0]' />
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="font-semibold">Address</div>
                    </div>
                    <div class="flex flex-wrap text-black text-sm ps-6 pt-6">
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="address_line_one">Address Line 1</label>
                            <TextArea type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.address" />
                            <InputError class="mt-2" v-if='errors && errors.address' :message='errors.address[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="address_line_two">Address Line 2</label>
                            <TextArea type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.address2" />
                            <InputError class="mt-2" v-if='errors && errors.address2' :message='errors.address2[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8" v-if="isinitialized">
                            <label class="block mb-1" for="country">Country</label>
                            <MultiSelect v-model="form.country" returns="id" :options="countries" label="name" :multiple="false" />
                            <InputError class="mt-2" v-if='errors && errors.country' :message='errors.country[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="state">State</label>
                            <MultiSelect v-model="form.state" returns="id" :options="states" label="name" :multiple="false" />
                            <InputError class="mt-2" v-if='errors && errors.state' :message='errors.state[0]' />
                        </div>
                        <div class="w-full md:w-1/2 mb-6 pe-8">
                            <label class="block mb-1" for="city">City</label>
                            <TextInput type="text" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.city" />
                            <InputError class="mt-2" v-if='errors && errors.city' :message='errors.city[0]' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </WebsiteLayout>
    <Resetpassword :show="resetform" @close="resetform = false"/>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Button from "@/Components/Button.vue";
import MultiSelect from "@/Components/MultiSelect.vue";
import { onMounted, ref } from "vue";
import { CameraIcon } from "@heroicons/vue/24/outline";
import Resetpassword from './resetpassword.vue';

const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    avatar: {
        type: String,
        required: false
    }
});

onMounted(() => {
    edit();
    get_states();
});

const form = ref(props.data);
const errors = ref([]);
const countries = ref([]);
const states = ref([]);
const file = ref([]);
const avatarurl = ref(props.avatar ? props.avatar : "/images/profile/profile.png" );
const component = ref(['profile']);
const isinitialized = ref(false);
const resetform = ref(false);

function edit() {
    axios.get(route('user.profile.edit')).then(response => {
        form.value = response.data.data;
        countries.value = response.data.countries;
        isinitialized.value = true;
    }).catch(error => {
        
    });
}

function resetpassword() {
    resetform.value = true;
}

function update(user) {
    axios.put(route('user.profile.update', { user: user }), form.value).then(response => {
        if (response.data.success) {
            console.log(response.data.success);
        }
    }).catch(error => {
        errors.value = error.response.data.errors;
    });
}

function get_states(){
    axios.get(route('getstates', { country: form.value.country })).then(response => {
        states.value = response.data;
    }).catch( (error) =>{

    });
}

function uploadFile(event) {
    file.value = event.target.files[0];
    avatarurl.value = URL.createObjectURL(file.value);
    submit(form.value.id);
};

function submit(user) {
    let vm = this;
    let formdata = new FormData();
    formdata.append('file', file.value);
    formdata.append('component', component.value)
    axios.post(route('user.profile.profileupdate', { user: user }), formdata).then(response => {
        if(response.data.success){
            console.log(response.data.success);
        }
    }).catch(error => {

    });
};

</script>
