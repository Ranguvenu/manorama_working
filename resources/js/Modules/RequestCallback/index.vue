<template>
    <a href="javascript:void(0)" v-on:click="show = true" :class="css_class">{{ label }}</a>
    <Modal :show="show" max-width="md" @close="close">
        <div class="mx-3 mt-3 mb-7">
            <span class="inline-block float-right">
                <div class="h-8 w-8 rounded-full cursor-pointer flex items-center justify-center bg-zinc-100 text-gray-400" v-on:click="close">
                    <svg class="h-4 w-4 " stroke="currentColor" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </span>
            <component :is="state" :data="form" :errors="errors" :isloading="isloading" @submit="submit" @resend="generate_otp"></component>
        </div>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import CallbackForm from './form.vue';
import OTPForm from './otp.vue';
import SuccessMessage from './success.vue';
export default{
    props:{
        label: {
            type: String,
            default: 'Request a Callback'
        },
        product: {
            type: Number,
            default: 0
        },
        css_class: {
            type: String,
            default: ''

        }
    },
    components:{
        Modal,
        "cbform": CallbackForm,
        "otp": OTPForm,
        "success": SuccessMessage
    },
    data(){
        return{
            show: false,
            errors: [],
            user: this.$page.props.auth.user,
            form: this.initialize(this.$page.props.auth.user),
            state: 'cbform',
            isloading: false
        }
    },
    methods:{
        initialize(user = {}){
            return {
                name: user ? user.fullname : '',
                email: user ? user.email : '',
                phone: {
                    code:  user ? user.code : '+91',
                    number: user ? user.phone : ''
                },
                package: this.product,
                otp: '',
                channel: 'sms',
                received_from: window.location.origin+window.location.pathname
            }
        },
        submit(){
            if(this.state == 'cbform'){
                this.isloading = true;
                this.generate_otp();
            }else if(this.state == 'otp'){
                this.store();
            }
        },
        generate_otp(){
            let vm = this;
            axios.post(route('callback.otp'), vm.form).then(response => {
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
            axios.post(route('callback.store'), vm.form).then(response => {
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
            this.form = this.initialize(this.$page.props.auth.user);
            this.state = 'cbform';
            this.show = false;
        }
    },
    mounted(){

    }
}
</script>
