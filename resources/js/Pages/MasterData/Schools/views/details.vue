<template>
<SideModal :show="show" max-width="2xl" @close="$emit('hide')">
    <template #header>
            <div class="text-lg">School Details </div>
        </template>
        <table class="min-w-full text-left text-sm font-light">
            <tbody>
                <tr class="border">
                    <td>School Name</td>
                    <td>{{ data.name }}</td>
                </tr>
                <tr class="border">
                    <td> Code</td>
                    <td>{{ data.code }}</td>
                </tr>
                <tr class="border">
                    <td> Location</td>
                    <td>{{ data.location }}</td>
                </tr>
                <tr class="border">
                    <td> District</td>
                    <td>{{ data.district}}</td>
                </tr>                    
                 <tr class="border">
                    <td> State</td>
                    <td>{{ data.state }}</td>
                </tr>                   
                  <tr class="border">
                    <td> Country</td>
                    <td>{{ data.country }}</td>
                </tr>                  
                   <tr class="border">
                    <td> Address</td>
                    <td>{{ data.address }}</td>
                </tr>                   
                  <tr class="border">
                    <td> Contact Details</td>
                    <td>{{ data.contact_details }}</td>
                </tr>                   
                  <tr class="border">
                    <td> Status</td>
                    <td>{{ data.is_published }}</td>
                </tr>                    
               </tbody>
        </table>
    <template #footer>
            <Button size="sm" color="default"  v-on:click="$emit('hide')">Close</Button> 
        </template>  
</SideModal>
</template>
<script>
    import ActionsDropdown from '@/Components/ActionsDropdown.vue';
    import SideModal from '@/Components/SideModal.vue';
    import Button from "@/Components/Button.vue";
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    export default{
        props:{
           details: {
                type: Number,
                default:false
            },
        },  
        components:{
            ActionsDropdown,
            SideModal,
            Button,
            ButtonOutline
        },
        emits: ["hide"],
        data(){
            return{
                data : [],
                show:false

            }
        },
        methods:{
            school_information(school){
                let vm = this;
           
                axios.get(route('masterdata.schools.show',{school:school})).then(response => {
                   vm.data = response.data.data;                   
                }).catch(error => {

                });
            },      
        },
        watch:{
            details(){
                if(this.details){
                    this.school_information(this.details);   
                }
                this.show = this.details ? true : false;
            }
        },
        mounted(){
            
        }
    }
</script>
