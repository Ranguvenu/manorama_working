<template>
    <!-- {{get_price()}} -->
    <!-- {{package.pricing}} -->

      
    <div v-if="package.is_published == 1">
        <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3" v-if="data && data.title">{{ data.title }}
        </div>
        <div class="bg-white" v-for="(price, index) in package.pricing">
            <div class="flex flex-wrap border-zinc-200 border rounded-[15px]">
                <div class="md:w-3/4 custom_md:w-3/5 w-full flex flex-wrap flex-col">
                    <div class="flex flex-wrap justify-between py-4 px-4 bg-white rounded-tl-2xl media_md:rounded-tr-2xl">
                        <div class="text-black text-xl font-semibold media_sm:mb-3">{{ package.title }}</div>
                        <div class="bg-pink-100 rounded border border-dashed border-rose-500 px-4 py-1 inline-flex"
                            v-if="data.batchdate">
                            <div class="text-black text-base">Batch start date </div>
                            <div class="text-black text-base mx-1">: </div>
                            <div class="text-rose-500 text-base"> {{ data.batchdate }} </div>
                        </div>
                    </div>
                    <div class="bg-pink-50 py-1 px-8"><span
                            class="text-emerald-950 text-sm font-semibold leading-[21px]">Subjects</span></div>

                    <div class="">{{ package.pricee }}dsdsdsd</div>

                </div>
                <div
                    class="md:w-1/4 custom_md:w-2/5 w-full flex flex-wrap flex-col bg-purple-50 md:rounded-tr-2xl rounded-br-[11px] media_md:rounded-bl-2xl px-3 py-5">
                    <div class="text-indigo-800 text-lg font-semibold leading-[27px] py-2 mb-3">{{ package.title }}</div>
                    <template v-if="subjects && subjects.length">
                        <div v-if="haspricing">
                            <div class="flex items-center mb-1" v-if="pricing && pricing.actual_price != pricing.selling_price">
                                <div class="text-gray-600 text-base line-through leading-[21px] mr-2">₹ {{ pricing.actual_price }}
                                </div>
                                <div class="text-green-600 text-base font-semibold mr-2"
                                    v-if="calculate_discount(pricing.actual_price, pricing.selling_price)">({{
                                        calculate_discount(pricing.actual_price, pricing.selling_price) }}%)</div>
                            </div>
                            <div class="flex items-center mb-6" v-if="pricing && pricing.actual_price">
                                <div class="text-zinc-800 text-[32px] font-bold mr-1">₹ {{ pricing.selling_price }}/-</div>
                                <div class="text-black text-xl font-medium">Only</div>
                            </div>
                            <div v-if="!has_purchased_variation">
                                <div class="w-full flex justify-center rounded-md mb-3">
                                    <BuyNowButton :packages="package" :variation="variation" :hasvariation="false" :batches="batches" />
                                </div>
                            </div>
                            <div v-else>
                                <a href="javascript:void(0)"
                                    class="w-full block bg-rose-500 cursor-not-allowed rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center">Already
                                    Purchased</a>
                            </div>
                            <div v-if="!package.has_trial && !package.has_purchased && package.can_enroll">
                                <div class="w-full flex justify-center bg-white rounded-md border-b-[4px] border-pink-600"
                                    v-if="package.is_trial_available">
                                    <FreeTrailButton :variation="variation" :hasvariation="false" :batches="batches"
                                        :duration="package.is_trial_available"
                                        class="px-[18px] py-2.5 text-center text-rose-500 text-sm font-medium leading-[21px]">Get
                                        Your Free Trial</FreeTrailButton>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="text-gray-600 border border-rose-500 text-sm p-3 text-center">Pricing is not available, Please contact us</div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-gray-600 border border-rose-500 text-sm p-3 text-center">Please choose any subject(s) to view the pricing.</div>
                    </template>
                </div>
            </div>
            <div class="media_md:flex hidden flex-wrap justify-between rounded-bl-[11px] px-8 py-5">
                <div><a v-if="data && data.studyplan" :href="data.studyplan" class="text-center text-rose-500 text-sm font-medium leading-[21px]" download>Download Study
                        Plan</a></div>
                <div class="flex items-center">
                    <a class="text-center text-rose-500 text-sm font-medium leading-[21px] mr-1"
                        href="javascript:void(0)">View Syllabus</a>
                    <ChevronDownIcon class="h-5 w-5 text-rose-500 font-semibold" aria-hidden="true" />
                </div>
            </div>
            <div class="border-zinc-200 border-l border-r border-b rounded-bl-[15px] rounded-br-[15px]"
                v-if="show_syllabus">
                <div class="p-6">
                    <SyllabusConfiguration :courses="data.courses"/>
                    <!--Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.-->
                </div>
            </div>
        </div>
    </div>
    <div v-else class="bg-rose-200 p-2 my-2 rounded-lg text-center">
        <div>The package you are looking for is nolonger available</div>        
    </div>
</template>
<script>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
import BuyNowButton from '@/Modules/Ecommerce/BuyNow/index.vue';
import FreeTrailButton from '@/Modules/Ecommerce/BuyNow/freetrial.vue';
import SyllabusConfiguration from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/Syllabus/view.vue';

export default {
    components: {
        ChevronDownIcon,
        BuyNowButton,
        FreeTrailButton,
        SyllabusConfiguration
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            show_syllabus: false,
            package: {},
            subjects: [],
            pricing: {},
            batches: [],
            variation: 0,
            has_purchased_variation: false,
            haspricing: false,
            pricess: '',
        }
    },
    methods: {
        show() {
            let vm = this;
            let payload = {
                package: vm.data.package
            };
            axios.post(route('website.components.show', { component: 'package' }), payload).then(response => {
                vm.package = response.data;
                console.log(vm.package.pricing);
                // console.log('fksjdfsdfsdfeeeeeeeeeee');
                if (vm.package && vm.package.subjects) {
                    vm.subjects = Array.from(new Set(vm.package.subjects.map(subject => subject.id)));
                    // vm.update_pricing();
                }
            }).catch(error => {

            });
        },
        // update_pricing() {
        //     let vm = this;

        //     vm.variation = Object.keys(vm.package.pricing).filter(key => {
        //         const value = vm.package.pricing[key];

        //         return JSON.stringify(value.sort((a, b) => a - b)) === JSON.stringify(vm.subjects.sort((a, b) => a - b));
        //     });

        //     // vm.haspricing = false;
        //     if(vm.variation && vm.variation.length){
        //         axios.get(route('ecommerce.pricing.show', { pricing: vm.variation })).then((response) => {
        //             vm.pricing = response.data.pricing;

        //             vm.batches = response.data.batches;
        //             vm.haspricing = true;
        //             vm.has_purchased_variation = response.data.has_purchased_variation;
        //         }).catch(error => {

        //         });
        //     }
        // },
        get_price(subjectid) {
            // let subjectid = [5]
            console.log(subjectid);
            console.log('fdsfsdfwwwwwwwwwwwwwwwwwww222')
            // console.log(subjectid.length)
            let vm = this;
            // console.log('fdsjfds');
            // console.log(subjectid);
            // vm.haspricing = false;
            if(subjectid && subjectid.length){
                axios.get(route('ecommerce.pricing.show', { pricing: subjectid })).then((response) => {
                    vm.pricing = response.data.pricing;
                    console.log('sdfhsadfhs');
                    console.log('from getprice', vm.pricing);
                    vm.pricess = vm.pricing;
                    vm.package.pricee = vm.pricing
                    // console.log('only price',vm.pricess);
                    // return vm.pricess;
                    // return vm.pricing
                }).catch(error => {

                });
            }
        },
        calculate_discount(actual, selling) {
            return Math.round(((actual - selling) / actual) * 100, 2);
        },
        is_disabled(disabled) {
            return disabled;
            if (!disabled) {
                return !disabled;
            }
            return (this.subjects && this.subjects.length == 1) ? true : false;
        }
    },
    watch: {
        "data.package": function () {
            this.show();
        }
    },
    mounted() {
        this.show();
    }
}
</script>


