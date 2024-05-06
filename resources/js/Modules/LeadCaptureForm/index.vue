<template>
    <div class="flex flex-col mt-2">
        <component :is="state" :data="form" :errors="errors" :options="options" :isloading="isloading" @submit="submit" @resend="generate_otp" @back="back"></component>
    </div>
</template>
<script>
import LeadCaptuteForm from "./form.vue";
import OTPForm from './otp.vue';
import SuccessMessage from './success.vue';
export default{
    components:{
        "leadcaptureform": LeadCaptuteForm,
        "otp": OTPForm,
        "success": SuccessMessage
    },
    data(){
        return{
            form: this.initialize(),
            state: 'leadcaptureform',
            options: {
                goals: []
            },
            errors: [],
            isloading: false
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
                received_from: '',
                tags: '',
                otp: '',
                channel: 'email',
                termsandconditions:''
            }
        },
        create(){
            let vm = this;
            axios.get(route('leadcapture.create')).then(response => {
                vm.options.goals = response.data;
            }).catch(error => {

            });
        },
        submit(){
            if(this.state == 'leadcaptureform'){
                this.isloading = true;
                this.generate_otp();
            }else if(this.state == 'otp'){
                this.store();
            }
        },
        generate_otp(){
            let vm = this;
            axios.post(route('leadcapture.otp'), vm.form).then(response => {
                if(response.data && response.data.success){
                    vm.state = 'otp';
                }
                vm.isloading = false;
            }).catch(error => {
                vm.errors = error.response.data.errors;
                vm.isloading = false;
            });
        },
        store(){
            let vm = this;
            vm.isloading = true;
            axios.post(route('leadcapture.store'), vm.form).then(response => {
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
        back(){
            this.form.otp = '';
            this.state = 'leadcaptureform';
        },
        close(){
            this.errors = [];
            this.form = this.initialize();
            this.state = 'leadcaptureform';
            this.show = false;
        }
    },
    mounted(){
        this.create();
    }
}
</script>
