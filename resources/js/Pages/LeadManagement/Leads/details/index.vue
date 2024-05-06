<template>
    <SideModal :show="show" max-width="5xl" @close="$emit('hide')">
        <template #header>
            <div class="text-lg">Details</div>
        </template>
        <div class="px-3">
            <Profile class="mb-5" :lead="lead"/>
            <div class="border border-gray-300">
                <div class="text-sm bg-gray-200 font-medium text-center text-gray-500 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap text-sm font-medium text-center">
                        <template v-for="(tab, index) in tabs">
                            <li class="mr-2" v-if="(tab.component != 'purchase-information') || (tab.component == 'purchase-information' && lead.is_registered)">
                                <a href="javascript:void(0)" :class="{ 'border-primary border-b-2 text-secondary': (tab.component === active) }" v-on:click="switch_tab(tab)" aria-current="page" class="inline-block py-3 px-3 text-gray-800 rounded-t-lg active ">{{ tab.name }}</a>
                            </li>
                        </template>
                    </ul>
                </div>
                <div class="m-3">
                    <component v-bind:is="active" :results="result.data" :lead="lead" :coupons="coupons"></component>
                </div>
            </div>
        </div>
        <template #footer>
            <ButtonRegular size="sm" color="default" v-on:click="$emit('hide')">Cancel</ButtonRegular>
        </template>
    </SideModal>
</template>
<script>
    import SideModal from '@/Components/SideModal.vue'; 
    import ButtonRegular from "@/Components/Button.vue";
    import Profile from './profile.vue';
    import CallDetails from './calldetails/index.vue';
    import FollowupDetails from './followup.vue';
    import AdditionalInformation from './additional.vue';
    import PurchaseInformation from './purchase-information.vue';
    export default{
        components:{
            SideModal,
            ButtonRegular,
            Profile,
            "call-details": CallDetails,
            "followup-details": FollowupDetails,
            "additional-information": AdditionalInformation,
            "purchase-information": PurchaseInformation
        },
        props:{
            details: {
                type: Number,
                default:false
            },
            category: {
                type: Object,
                required: true
            }
        },
        emits: ["hide"],
        data(){
            return{
                show: false,
                tabs: [
                    {
                        name: 'Follow-up Details',
                        slug: 'followup-details',
                        component: 'followup-details'
                    },
                    {
                        name: 'Call Details',
                        slug: 'call-details',
                        component: 'call-details'
                    },
                    {
                        name: 'Additional Information',
                        slug: 'additional-information',
                        component: 'additional-information'
                    },
                    {
                        name: 'Purchase Information',
                        slug: 'purchase-information',
                        component: 'purchase-information'
                    }
                ],
                result: {
                   data: [], 
                },
                active: 'followup-details',
                lead: {},
                coupons: {}
            }
        },
        methods:{
            lead_information(interested){
                let vm = this;
                axios.get(route('leads.category.show', {category:vm.category.slug, interested: interested})).then(response => {
                    vm.lead = response.data.data;
                    vm.coupons = response.data.coupons;
                }).catch(error => {

                });
            },
            switch_tab(tab){
                this.active = tab.component;
            }
        },
        watch:{
            details(){
                if(this.details){
                    this.lead_information(this.details);   
                }
                this.show = this.details ? true : false;
            }
        },
        mounted(){

        }
    }
</script>
