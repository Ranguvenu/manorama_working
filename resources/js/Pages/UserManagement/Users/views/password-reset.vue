<template>
    <a href="javascript:void(0)" v-on:click="show = true" class="block py-1 px-4 actions_icon">Reset Password</a>
    <Modal :show="show" max-width="xl" @close="close_modal">
        <template #header>
            <div class="text-lg">Reset Password</div>
        </template>
        <div class="m-3">
            <div>
                <InputLabel>New Password <span class="text-red-600">*</span></InputLabel>
                <TextInput
                    type="password"
                    class="mt-1 w-full"
                    placeholder="Enter new password"
                    v-model="form.password"
                    autofocus
                    autocomplete="lastname"
                />
                <InputError class="mt-2" v-if="errors && errors.password" :message="errors.password[0]"/>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="close_modal">Close</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-on:click="reset">Reset Password</ButtonRegular>
        </template>
    </Modal>
</template>
<script>
    import Modal from '@/Components/Modal.vue';
    import ButtonRegular from '@/Components/Button.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue'; 
import axios from 'axios';
    export default{
        props:{
            user: {
                type: Number,
                required: true
            }
        },
        components:{
            Modal,
            ButtonRegular,
            InputError,
            InputLabel,
            TextInput
        },
        data(){
            return {
                show: false,
                form: this.initialize(),
                errors: []
            }
        },
        methods: {
            initialize(){
                return {
                    password: ''
                }
            },
            close_modal(){
                this.show = false;
                this.errors = [];
                this.form = this.initialize();
            },
            reset(){
                let vm = this;
                axios.put(route('users.reset', {user: vm.user}), vm.form).then(response => {
                    if(response.data && response.data.success){
                        vm.close_modal();
                        this.$toast.success(response.data.message, {                        
                            position: 'bottom-right'                   
                        });
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                });
            }
        },
        mounted(){

        }
    }
</script>
