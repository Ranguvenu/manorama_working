<template>
    <Modal :show="show" max-width="2xl" @close="close_application">
        <template #header>
            <div class="text-lg">Application Details</div>
        </template>
        <div class="px-3"> 	
            <div class="text-lg mb-3 font-semibold">Applicant Details</div>
            <table class="min-w-full text-left text-sm font-light" v-if="application && application.user">
                <tbody>
                    <tr>
                        <td> First Name</td>                   
                        <td>{{ application.user.firstname }}</td>
                    </tr>
                    <tr>
                        <td> Last Name</td>
                        <td>{{ application.user.lastname }}</td>
                    </tr>
                    <tr>
                        <td> Email</td>
                        <td>{{ application.user.email }}</td>   
                    </tr>
                    <tr>
                        <td> Phone Number</td>
                        <td>{{ application.user.country_code }}{{ application.user.phone_number }}</td>
                    </tr>                     
                    <tr>
                        <td> Resume</td>                           
                        <td> <a class = "bg-primary text-white py-1 px-4 rounded" :href= "application.resume" download>Download Resume</a></td>        
                    </tr>
                    <tr>
                        <td> Highest Qualification</td>                           
                        <td> {{ application.qualification }}</td>        
                    </tr>
                </tbody>
            </table>
            <div class="mt-7">
                <div class="text-lg font-semibold mb-3">Assignments</div>
                <div class="border border-gray-200 mb-3 px-4 py-2 rounded-lg shadow" v-for="(assignment, index) in application.assignments">
                    <div class="text-md mb-2">{{ assignment.posting_assignment.title }}</div>
                    <div class="text-gray-600 text-sm" v-html="assignment.posting_assignment.description"></div>
                    <div class="mt-5 mb-2">
                        <a class = "bg-primary text-white py-1 px-4 rounded" :href= "assignment.url" download>Download</a>  
                    </div>
                </div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default"  v-on:click="close_application">Close</ButtonRegular>                
        </template>
    </Modal>
</template>
<script>
import Modal from '@/Components/Modal.vue';
import ButtonRegular from '@/Components/Button.vue';
export default{
    props: {
        current: {
            type: Number,
            default: false
        }
    },
    components:{
        Modal,
        ButtonRegular
    },
    data(){
        return{
            application: {},
            show: false
        }
    },
    emits: ['close-application'],
    methods:{
        view_application(application){
            let vm = this;
            axios.post(route('careers.application.show', { application: application })).then( (response) => {
                vm.application = response.data.data;
            }).catch(error => {

            });
        },
        close_application(){
            this.application = {};
            this.$emit('close-application');
        }
    },
    watch: {
        current() {
            if(this.current){
                this.view_application(this.current);   
            }
            this.show = this.current ? true : false; 
        }
    },
    mounted(){

    }
}
</script>


