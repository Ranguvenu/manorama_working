<template>
    <div class="bg_radial_white_pink" v-if="!(this.profile && this.profile.dob && this.profile.gender)">
        <div class="sm:max-w-6xl max-w-screen-2xl mx-auto w-full px-16 py-12">
            <div class="flex flex-col justify-left">
                <div class="text-zinc-800 text-[18px] font-semibold leading-[35px] mb-1">Complete Profile</div>
                <div class="text-black text-base leading-relaxed mb-6">Thank you for your payment! To ensure we have all the necessary information, could you please provide us with a few more details?</div>
                <div class="flex flex-wrap flex-row">
                    <div class="md:w-1/3 mb-6 pe-8">
                        <label class="block mb-1 text-gray-600" for="address_line_one">DOB</label>
                        <input type="date" class="bg-white rounded-[5px] border border-stone-300 p-[6px] block w-full" v-model="form.dob">
                    </div>
                    <div class="md:w-2/3 mb-6 pe-8">
                        <label class="block mb-1 text-gray-600" for="address_line_one">Gender</label>
                        <div class="flex my-2">
                            <div>
                                <input type="radio" v-model="form.gender" value="1">
                                <label for="html" class="mx-2 text-gray-800">Male</label>
                            </div>
                            <div class="mx-3">
                                <input type="radio" v-model="form.gender" value="2">
                                <label for="html" class="mx-2 text-gray-800">Female</label>
                            </div>
                            <div>
                                <input type="radio" v-model="form.gender" value="3">
                                <label for="html" class="mx-2 text-gray-800">Other</label>
                            </div>
                        </div>
                    </div>
                </div>
                <UserInformation :profile="profile"/>
                <AddressInformation class="mt-4" :profile="profile"/>
                <div class="sm:max-w-6xl mx-auto w-full">
                    <div class="my-4 flex justify-start">
                        <a :href="route('integrations.sso.login')" class="px-[18px] py-2.5 border border-rose-600 rounded-[5px] text-rose-600 text-base font-medium me-2">Skip</a>
                        <a href="javascript:void(0)" v-on:click="complete_profile" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Save & Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import UserInformation from './user.vue';
import AddressInformation from './address.vue';
import axios from 'axios';
export default{
    components:{
        UserInformation,
        AddressInformation
    },
    props:{
        profile: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            form: this.initialize()
        }
    },
    methods:{
        initialize(){
            return {
                dob: this.profile ? this.profile.dob : '',
                gender: this.profile ? this.profile.gender : 0
            }
        },
        complete_profile(){
            let vm = this;
            axios.post(route('profile.complete', {user: vm.profile.id}), vm.form).then(response => {
                if(response && response.data.success){
                    window.location.href = route('integrations.sso.login');
                }
            }).catch(error => {

            });
        }
    },
    mounted(){
        if(this.profile && this.profile.dob && this.profile.gender){
            window.location.href = route('integrations.sso.login');
        }
    }
}
</script>
