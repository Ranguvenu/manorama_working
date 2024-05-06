<template>
    <SideModal :show="show" max-width="3xl" @close="$emit('hide')">
        <template #header>
            <div class="text-lg">College Details</div>
        </template>
        <div class="border border-gray-300">
	        <table class="min-w-full text-sm">
	        	<tbody>
		        	<tr class="border">
		        		<td>College Name</td>
		        		<td class="break-all">{{ college.name }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Established Year</td>
		        		<td>{{ college.established_year }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Type of College</td>
		        		<td>{{ college.type }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Address</td>
		        		<td>{{ college.address }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Country</td>
		        		<td>{{ college.country }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>State</td>
		        		<td>{{ college.state }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>District</td>
		        		<td>{{ college.district }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Pin Code</td>
		        		<td>{{ college.pincode }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Contact Person</td>
		        		<td>{{ college.contact_person }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Phone</td>
		        		<td>{{ college.phone }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Fax</td>
		        		<td>{{ college.fax }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Email</td>
		        		<td>{{ college.email }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Website</td>
		        		<td>{{ college.website }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Student intake/Year</td>
		        		<td>{{ college.student_intake }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>NAT ranking</td>
		        		<td>{{ college.nat_rank }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Is deemed</td>
		        		<td>{{ college.is_deemed ? 'Yes' : 'No' }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Name of Principal</td>
		        		<td>{{ college.name_of_principal }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Contact Number of Principal</td>
		        		<td>{{ college.contact_no_of_principal }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Email Id of Principal</td>
		        		<td>{{ college.email_of_principal }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>College admin</td>
		        		<td>{{ college.admin }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Short Description</td>
		        		<td class="break-all"><p v-html="college.short_description"></p></td>
		        	</tr>
		        	<tr class="border">
		        		<td>Why Join?</td>
		        		<td class="break-all"><p v-html="college.why_join"></p></td>
		        	</tr>
		        	<tr class="border">
		        		<td>High Light Text</td>
		        		<td class="break-all">{{ college.high_light_text }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Similar Names of Location</td>
		        		<td class="break-all">{{ college.similar_location }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Similar Names of College</td>
		        		<td class="break-all">{{ college.similar_college }}</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Brochure</td>
		        		<td>
			        		<a v-bind:href="college.brochure" download>
	                        	<div class="inline-flex items-center gap-1">
		                            <i class="shrink-0 w-7 h-7">
		                                <img src="/images/college_card_icons/Brochure.png" alt="">
		                            </i>
	                            	<span class="text-secondary">Brochure</span>
	                        	</div>
	                    	</a>
                		</td>
		        	</tr>
		        	<tr class="border">
		        		<td>Application Form</td>
		        		<td>
		        			<a v-bind:href="college.application_form" download>
		        			    <div class="inline-flex items-center gap-1">
		        			        <i class="shrink-0 w-7 h-7">
		        			            <img src="/images/college_card_icons/Application.png" alt="">
		        			        </i>
		        			        <span class="text-secondary">Application Form</span>
		        			    </div>
		        			</a>
		        		</td>
		        	</tr>
	        	</tbody>
	        </table>
        </div>
	    <div class="py-1 px-2 text-lg font-semibold">College Facilities</div>
        <div class="border border-gray-300">
	        <table class="text-sm">
	        	<tbody>	        		
		        	<tr class="w-full" v-for="facility in college.facilities" key="facility.slug">
                        <td>{{ facility.name }}</td>
                        <td>{{ facility.is_available ? 'Is available' : 'Not available' }}</td>
                        <td>{{ facility.description }}</td>
                    </tr>
	        	</tbody>
	        </table>
	    </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('hide')">Cancel</ButtonRegular>
        </template>
    </SideModal>
</template>

<script>
    import SideModal from '@/Components/SideModal.vue'; 
    import ButtonRegular from "@/Components/Button.vue";
    export default{
        components:{
            SideModal,
            ButtonRegular,
        },
        props:{
            details: {
                type: Number,
                default:false
            },
        },
        emits: ["hide"],
        data(){
            return{
                show: false,
                college: {}
            }
        },
        methods:{
            college_information(college){
                let vm = this;
                axios.get(route('masterdata.colleges.show', { college: college})).then(response => {
                    vm.college = response.data.data;
                    console.log("vm.college", vm.college);
                }).catch(error => {

                });
            },
        },
        watch:{
            details(){
                if(this.details){
                    this.college_information(this.details);   
                }
                this.show = this.details ? true : false;
            }
        },
        mounted(){

        }
    }
</script>
