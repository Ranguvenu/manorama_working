<template>
    <SideModal :show="show" max-width="2xl" @close="$emit('close')">
        <template #header>
            <div class="text-lg"><span>Update</span> Profile</div>
        </template>
        <div class="px-3" v-if="show && form.email">
            <div class="mt-3">
                <InputLabel for="firstname" value="First Name" />
                <TextInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus
                    autocomplete="firstname" />
                <InputError class="mt-2" v-if="errors && errors.firstname" :message="errors.firstname[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="name" value="Last Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.lastname" required autofocus
                    autocomplete="lastname" />
                <InputError class="mt-2" v-if="errors && errors.lastname" :message="errors.lastname[0]" />
            </div>

            <div class="mt-3">
                <InputLabel for="name" value="User Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" v-bind:disabled="true" />
                <InputError class="mt-2" v-if="errors && errors.name" :message="errors.name[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="phone" value="Phone Number" />
                <TextInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone_number" required autofocus
                    autocomplete="phone" />
                <InputError class="mt-2" v-if="errors && errors.phone" :message="errors.phone[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="email" v-bind:disabled="true" />
                <InputError class="mt-2" v-if="errors && errors.email" :message="errors.email[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="dob" value="DOB" />
                <TextInput id="dob" type="date" class="mt-1 block w-full" v-model="form.dob" required autofocus
                    autocomplete="date" />
                <InputError class="mt-2" v-if="errors && errors.dob" :message="errors.dob[0]" />
            </div>
            <div class="mt-3">
                <InputLabel class="mb-3" for="profile-id" value="Avatar" />
                <MediaButton accepts="png,jpeg,jpg,svg,webp" component="profile" name="Upload Avatar" :multiple="false" return_type="id"
                    v-model="form.profile_id" />
                <InputError class="mt-2" v-if="errors && errors.profile_id" :message="errors.profile_id[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="address" value="Address" />
                <TextArea id="name" type="text" class="mt-1 block w-full" v-model="form.address" required autofocus
                    autocomplete="name" />
                <InputError class="mt-2" v-if="errors && errors.address" :message="errors.address[0]" />
            </div>
            <!--<div class="mt-3">
                <InputLabel for="city" value="City" />
                <TextInput id="city" type="text" class="mt-1 block w-full" v-model="form.city" required autofocus
                    autocomplete="city" />
                <InputError class="mt-2" v-if="errors && errors.city" :message="errors.city[0]" />
            </div>-->
            <div class="mt-3">
                <InputLabel for="country" value="Country" />
                <MultiSelect class="mt-2" v-model="form.country" returns="id" :options="data.countries" label="name" :multiple="false"/>
                <InputError class="mt-2" v-if="errors && errors.country" :message="errors.country[0]" />
            </div>
            <div class="mt-3">
                <InputLabel for="state" value="State" />
                <MultiSelect class="mt-2" v-model="form.state" returns="id" :options="data.states" label="name" :multiple="false"/>
                <InputError class="mt-2" v-if="errors && errors.state" :message="errors.state[0]" />
            </div>
        </div>
        <template #footer>
            <Button size="sm" color="default" v-on:click="close_modal">Close</Button>
            <Button size="sm" color="primary" v-on:click="update(form.id)">Update Profile</Button>
        </template>
    </SideModal>
</template>
<script>
import SideModal from '@/Components/SideModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import Button from "@/Components/Button.vue";
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MediaButton from "@/Components/MediaButton.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

export default {
    components: {
        SideModal,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
        Button,
        ButtonOutline,
        MediaButton,
        MultiSelect,
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        show: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            form: {},
            errors: [],
            data: {
                countries: [],
                states: [],
            },
        }
    },
    methods: {
        initialize() {
            return {
                id: 0,
                firstname: '',
                lastname: '',
                name: '',
                email: '',
                dob: '',
                profile_id: 0,
                address: '',
                city: '',
                state: '',
                country: '',
            }
        },
        update(user) {
            let vm = this;
            axios.put(route('profile.update', { user: user }), vm.form).then(response => {
                if (response.data.success) {
                    vm.close_modal();
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        open_modal() {
            let vm = this;
            axios.get(route('profile.edit')).then(response => {
                vm.form = response.data.data;
                vm.data.countries = response.data.countries;
            }).catch(error => {
                
            });

        },
        close_modal() {
            this.form = this.initialize();
            this.$emit('refresh');
            this.$emit('close');
            window.location.reload();
        }
    },
    watch:{
        show() {
            if(this.show){
                this.open_modal();
            }
        },
        "form.country"() {
            if (this.form.country){
                    let vm = this;
                    axios.get('/states/'+vm.form.country).then(response => {
                    vm.data.states = response.data;
                });
            }
        },
    },
    mounted(){
        
    }
}
</script>
