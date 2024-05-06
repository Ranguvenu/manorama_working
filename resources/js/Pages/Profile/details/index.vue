<template>
    <div>
        <div class="flex justify-between align-items-center">
            <div class="flex py-4 w-3/4">
                <img v-if="!data.avatar" src="/images/profile/profile.png" alt="Profile Picture of {{ data.name }}" class="rounded-md h-32 w-32">
                <img v-if="data.avatar" :src="data.avatar" class="rounded-lg h-32 w-32">
                <div class="py-3 px-5">             
                    <span class="inline-flex items-center mb-3 font-medium"> 
                        <span class="text-gray-800">{{ data.name }}</span>
                        <PencilSquareIcon  class="h-5 w-5 mx-3 text-gray-800 cursor-pointer" aria-hidden="true" v-on:click="edit"/>       
                    </span>
                    <span class="flex items-center mb-3 font-medium">
                        <PhoneIcon class="h-4 w-4 text-gray-500 mr-3"/>
                        <span class="text-gray-800">{{ data.phone }}</span>
                    </span>
                    <span class="flex items-center mb-3 font-medium">
                        <EnvelopeIcon class="h-4 w-4 text-gray-500 mr-3"/>
                        <span class="text-gray-800">{{data.email}}</span>
                    </span>                       
                </div> 
            </div>
            <span class="pl-3 flow-root">
                <h5 class="text-sm font-medium">Profile Completion</h5>
                <CircleProgressBar :value="data.completed" :max="100" class="profile-circle-progressbar mt-5">{{data.completed}}%</CircleProgressBar>
            </span>
        </div>
        <div class="mt-5">
            <div class="border border-gray-300">
                <div class="text-sm bg-gray-200 font-medium text-center text-gray-500 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center">
                        <li class="mr-2" v-for="(tab, index) in tabs">
                            <a href="javascript:void(0)" :class="{ 'border-primary border-b-2 text-secondary': (tab.component === active) }" v-on:click="switch_tab(tab)" aria-current="page" class="inline-block py-3 px-3 text-gray-800 rounded-t-lg active ">{{ tab.name }}</a>
                        </li>
                    </ul>
                </div>
                <div class="m-3">
                    <component :data="data" v-bind:is="active"></component>
                </div>
            </div>
        </div>
        <EditProfile :data="data" :show="edit_profile" @close="edit_profile = false"/>
    </div>
</template>
<script>
import { CircleProgressBar } from 'vue3-m-circle-progress-bar';
import { PencilSquareIcon, PhoneIcon, EnvelopeIcon } from '@heroicons/vue/24/solid';
import PersonalDetails from './personal-details.vue';
import UpdatePassword from './update-password.vue';
import PurchaseInformation from './purchase-information.vue';
import EditProfile from '../edit.vue';
export default{
    components:{
        CircleProgressBar,
        PencilSquareIcon,
        PhoneIcon,
        EnvelopeIcon,
        EditProfile,
        "personal-details": PersonalDetails,
        "update-password": UpdatePassword,
        "purchase-information": PurchaseInformation
    },
    props:{
        data: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            tabs: [
                {
                    name: 'Personal Details',
                    slug: 'personal-details',
                    component: 'personal-details'
                },
                {
                    name: 'Update Password',
                    slug: 'update-password',
                    component: 'update-password'
                },
                {
                    name: 'Purchase Information',
                    slug: 'purchase-information',
                    component: 'purchase-information'
                }
            ],
            active: 'personal-details',
            edit_profile: false
        }
    },
    methods:{
        switch_tab(tab){
            this.active = tab.component;
        },
        edit(){
            this.edit_profile = true;
        }
    }
}
</script>