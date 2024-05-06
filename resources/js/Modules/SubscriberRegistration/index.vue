<template>
    <component :is="state" :data="form" :errors="errors" :isloading="isloading" @submit="submit" @resend="generate_otp"></component>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import SubscriberRegistrationForm from './form.vue';
import OTPForm from './otp.vue';
import SuccessMessage from './success.vue';
import axios from 'axios';
export default{
    components:{
        Modal,
        "cbform": SubscriberRegistrationForm,
        "otp": OTPForm,
        "success": SuccessMessage
    },
    data(){
        return{
            show: false,
            errors: [],
            form: this.initialize(),
            state: 'cbform',
            isloading: false,
        }
    },
    methods:{
        initialize(){
            return {
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: {
                        code: '+91',
                        number: ''
                    },
                    password: '',
                    otp: '',
                    channel: 'sms',
                }
        },
        submit(){
            if(this.state == 'cbform'){
                this.generate_otp();
            }else if(this.state == 'otp'){
                this.store();
            }
        },
        generate_otp(){
            let vm = this;
            vm.isloading = true;
            axios.post(route('subscriber.otp'), vm.form).then(response => {
                if(response.data && response.data.success){
                    vm.state = 'otp';
                }
                vm.isloading = false;
            }).catch(error => {
                vm.isloading = false;
                vm.errors = error.response.data.errors;
            });
        },
        store(){
            let vm = this;
            vm.isloading = true;
            axios.post(route('subscriber.store'), vm.form).then(response => {
                if(response.data && response.data.success){
                    vm.state = 'success';
                }else{
                    vm.errors = response.data;
                }
                vm.isloading = false;
            }).catch(error => {
                vm.errors = error.response.data.errors;
                vm.isloading = false;
            });
        },
        close(){
            this.errors = [];
            this.form = this.initialize();
            this.state = 'cbform';
            this.show = false;
        }
    },
    mounted(){

    }
}
</script>
