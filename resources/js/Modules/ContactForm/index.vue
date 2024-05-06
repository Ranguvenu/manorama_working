<template>
    <component :is="state" :data="form" :errors="errors" @submit="submit"></component>
</template>
<script>
import ContactForm from './form.vue';
export default{
    components:{
        "contactform": ContactForm,
    },
    data(){
        return{
            form: this.initialize(),
            state: 'contactform',
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
                message: '',
            }
        },
        submit(){
            let vm = this;
            axios.post(route('contact.store'), vm.form).then(response => {
                if(response.data.success){
                    this.$toast.success(response.data.message,{
                        position: 'bottom-right'
                    });
                    this.$emit('refresh');
                    this.form = this.initialize();
                    vm.errors = [];
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
    },
    mounted(){

    }
}
</script>
