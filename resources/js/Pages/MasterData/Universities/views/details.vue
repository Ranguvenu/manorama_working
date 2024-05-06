<template>
    <SideModal :show="show" max-width="2xl" @close="$emit('hide')">
        <template #header>
                <div class="text-lg">University Details </div>
            </template>
            <table class="min-w-full text-left text-sm font-light">
                <tbody>
                    <tr class="border">
                        <td>University Name</td>
                        <td>{{ data.name }}</td>
                    </tr>
                    <tr class="border">
                        <td> Code</td>
                        <td>{{ data.code }}</td>
                    </tr>
                    <tr class="border">
                        <td> Established On</td>
                        <td>{{ data.established_on }}</td>
                    </tr>

                    <tr class="border">
                        <td> Email</td>
                        <td>{{ data.email }}</td>
                    </tr>

                    <tr class="border">
                        <td> Website</td>
                        <td>{{ data.website }}</td>
                    </tr>

                    <tr class="border">
                        <td> Location</td>
                        <td>{{ data.location }}</td>
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
                        <td> PinCode</td>
                        <td>{{ data.pincode }}</td>
                    </tr>                  
                      <tr class="border">
                        <td> Phone Number</td>
                        <td>{{ data.phone }}</td>
                    </tr>     
                    <tr class="border">
                        <td> Fax</td>
                        <td>{{ data.fax }}</td>
                    </tr> 
                    <tr class="border">
                        <td> Description</td>
                        <td class="break-words"><div v-html="data.description"></div></td>
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
        data(){
            return{
                data : [],
                show :false

            }
        },
        methods:{
            university_details(university) {
                let vm = this;
           
           axios.get(route('masterdata.universities.show',{universities:university})).then(response => {
              vm.data = response.data.data;                   
           }).catch(error => {

           });  
            },


        },
        watch:{
            details(){
                if(this.details){
                    this.university_details(this.details);   
                }
                this.show = this.details ? true : false;
            }
        },    
        mounted(){
            
        }
    }
</script>
