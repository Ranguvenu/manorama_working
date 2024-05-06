<template>
    <div>
        <div class="flex flex-wrap justify-between items-center" v-if="package.is_published">
            <div class="lg:w-2/3 custom_md:w-1/2 w-full flex flex-col lg:pr-12 custom_md:pr-3 media_md:mb-4">
                <div class="text-zinc-800 text-[25px] font-semibold mb-4" v-if="data && data.title">{{ data.title }}</div>
                <div class="text-zinc-800 text-base leading-relaxed">
                    <div class="ck_content" v-html="data.description"></div>
                </div>
            </div>
            <div class="lg:w-1/3 custom_md:w-1/2 w-full flex flex-col lg:pl-8 custom_md:pl-3">
                <div class="bg-white rounded-[11px] border border-rose-500 px-4 py-6">
                    <div class="text-zinc-800 text-[19px] font-semibold border-b  pb-4 mb-4">{{ package.title }}</div>
                    <div class="pb-4 mb-4 border-b-2 border-dashed">
                        <div class="text-gray-600 text-[13px] font-medium">Course Fee</div>
                        <div class="flex items-center">
                            <div class="text-stone-300 text-[29px] font-semibold mr-3" v-if="pricing && pricing.actual_price != pricing.selling_price">
                                <span class="mr-1">₹</span>
                                <span class="line-through">{{ pricing.actual_price }}</span>
                            </div>
                            <div class="text-black text-[29px] font-semibold mr-3" v-if="pricing && pricing.selling_price">
                                <span class="mr-1">₹</span>
                                <span>{{ pricing.selling_price }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="pb-8 mb-4 border-b-2 border-dashed ">
                        <div class="text-zinc-800 text-base font-semibold mb-2">Class Timing</div>
                        <div class="flex items-center text-gray-600 text-base" v-if="data && data.batchduration">
                            {{ data.batchduration }}
                        </div>
                        <div class="text-gray-600 text-base" v-if="data && data.timings">{{ data.timings }}</div>
                    </div>
                    <div v-if="!package.has_purchased" class="mt-6 mb-4">
                        <BuyNowButton :packages="package" :variation="variation" :hasvariation="has_variation(package.batches)" :batches="package.batches"/>
                    </div>
                    <div v-else class="mt-6 mb-4">
                        <a href="javascript:void(0)" class="w-full block bg-rose-500 cursor-not-allowed rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center">Already Purchased</a>
                    </div>
                    <div v-if="!package.has_trial && !package.has_purchased && package.can_enroll">
                        <div class="w-full flex justify-center bg-white rounded-md border border-b-[4px] border-pink-600"
                            v-if="package.is_trial_available">
                            <FreeTrailButton :variation="variation" :hasvariation="false" :batches="package.batches"
                                :duration="package.is_trial_available"
                                class="px-[18px] py-2.5 text-center text-rose-500 text-sm font-medium leading-[21px]">Get
                                Your Free Trial</FreeTrailButton>
                        </div>
                    </div>
                    <div class="text-indigo-800 text-[13px] leading-snug">You can access recorded class calls on your dashboard after each session</div>
                </div>
            </div>
        </div>
        <div v-else class="bg-rose-200 p-2 my-2 rounded-lg text-center">
            <div>The package you are looking for is nolonger available</div>        
        </div>
    </div>
</template>
<script>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
import BuyNowButton from '@/Modules/Ecommerce/BuyNow/index.vue';
import FreeTrailButton from '@/Modules/Ecommerce/BuyNow/freetrial.vue';
export default {
    components: {
        ChevronDownIcon,
        BuyNowButton,
        FreeTrailButton
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            package: {},
            subjects: [],
            pricing: {},
            variation: 0
        }
    },
    methods: {
        show(){
            let vm = this;
            let payload = {
                package: vm.data.package
            };
            axios.post(route('website.components.show', {component: 'package'}), payload).then(response => {
                vm.package = response.data;
                if(vm.package && vm.package.subjects){
                    vm.subjects =  Array.from(new Set(vm.package.subjects.map(subject => subject.id)));
                    vm.update_pricing();
                }
            }).catch(error => {

            });
        },
        update_pricing(){
            let vm = this;
            vm.variation = Object.keys(vm.package.pricing).filter(key => {
                const value = vm.package.pricing[key];
                return JSON.stringify(value) === JSON.stringify(vm.subjects.sort((a, b) => a - b));
            });
            axios.get(route('ecommerce.pricing.show', {pricing: vm.variation})).then( (response) => {
                vm.pricing = response.data.pricing;
                vm.package.has_purchased = response.data.has_purchased_variation
            }).catch(error => {

            });
        },
        has_variation(batches){
            return (batches && batches.length > 1) ? true : false;
        },
        enroll(){
            this.$store.dispatch('add_variation', this.variation);
            this.$inertia.visit(route('checkout.index'));
        }
    },
    watch: {
        "data.package": function(){
            if(this.data && this.data.package){
                this.show();
            }
        }
    },
    mounted() {
        this.show();
    }
}
</script>


