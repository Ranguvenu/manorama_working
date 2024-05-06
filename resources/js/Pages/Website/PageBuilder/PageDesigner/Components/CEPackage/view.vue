<template>
    <div v-if="package.is_published == 1">
        <div class="text-zinc-800 text-[25px] font-semibold mb-4" v-if="data && data.title">{{ data.title }}</div>
        <div class="text-zinc-800 text-base leading-7 mb-4" v-if="data && data.description">
            <div class="ck_content" v-html="data.description"></div>
        </div>
        <div class="flex flex-wrap justify-between media_md:flex-col-reverse">
            <div class="md:w-2/3 custom_md:w-3/5 w-full flex flex-col md:pr-3">
                <div class="rounded-[11px] border border-neutral-200">
                    <div class="flex justify-between bg-stone-50 rounded-tl-[11px] rounded-tr-[11px] border border-neutral-200 px-4 py-3">
                        <div class="text-zinc-800 text-[15px] font-semibold">Topics</div>
                        <div class="text-zinc-800 text-[15px] font-semibold md:pr-8 pr-2">Duration</div>
                    </div>
                    <div class="flex flex-col bg-white max-h-96 overflow-y-auto">
                        <div class="flex items-center justify-between mx-4 py-2 border-b border-zinc-100" v-for="(topic, index) in data.topics">
                            <div class="flex items-center md:px-2 media_md:pr-3">
                                <div class="mr-2 flex text-rose-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" /></svg>
                                </div>
                                <div class="text-black text-sm font-medium">{{ topic.title }}</div>
                            </div>
                            <div class="text-black text-sm md:pr-12 pr-2">{{ topic.duration }}</div>
                        </div>
                    </div>
                    <div class="flex justify-between bg-stone-50 rounded-bl-[11px] rounded-br-[11px] border border-neutral-200 px-4 py-3">
                        <div class="text-black text-sm">Total</div>
                        <div class="text-black text-sm font-semibold pr-10">{{ data.duration }}</div>
                    </div>
                </div>
            </div>
            <div class="md:w-1/3 custom_md:w-2/5 w-full flex flex-col md:pl-3 media_md:mb-6">
                <div class="bg-white rounded-[11px] border border-neutral-200 px-6 py-4">
                    <div class="text-zinc-800 text-[19px] font-semibold border-b border-neutral-200 pb-4 mb-4" v-if="package && package.title">{{ package.title }}</div>
                    <div v-if="pricing.selling_price == 0" class="flex flex-col items-center justify-center w-full bg-pink-50 rounded border border-dashed border-rose-500 py-10 mb-4">
                        <div class="text-black text-2xl font-bold">Free</div>
                        <div class="text-black text-sm font-medium">You can enrol in this course for free</div>
                    </div>
                    <div v-else class="flex flex-col items-center justify-center w-full bg-pink-50 rounded border border-dashed border-rose-500 py-10 mb-4">
                        <div class="text-black text-2xl font-bold">Rs {{pricing.selling_price}}</div>
                        <div class="text-black text-sm font-medium">Inclusive of all taxes</div>
                    </div>
                    <div class="flex flex-col items-center justify-center w-full">
                        <div class="text-zinc-800 text-[15px] font-bold" v-if="data && data.timings">{{ data.timings }}</div>
                        <div class="text-gray-600 text-base leading-relaxed" v-if="data && data.batchstart">{{ data.batchstart }}</div>
                    </div>
                    <div v-if="!package.has_purchased" class="mt-6 mb-4">
                        <BuyNowButton :packages="package" :variation="variation" :hasvariation="has_variation(package.batches)" :batches="package.batches"/>
                    </div>
                    <div v-else>
                        <a href="javascript:void(0)" class="w-full block bg-rose-500 cursor-not-allowed rounded-lg py-2.5 text-zinc-100 text-base font-semibold text-center">Already Purchased</a>
                    </div>
                    <div v-if="!package.has_trial && !package.has_purchased && package.can_enroll">
                        <div class="w-full flex justify-center bg-white rounded-md border-b-[4px] border border-pink-600"
                            v-if="package.is_trial_available">
                            <FreeTrailButton :variation="variation" :hasvariation="false" :batches="package.batches"
                                :duration="package.is_trial_available"
                                class="px-[18px] py-2.5 text-center text-rose-500 text-sm font-medium leading-[21px]">Get
                                Your Free Trial</FreeTrailButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="bg-rose-200 p-2 my-2 rounded-lg text-center">
        <div>The package you are looking for is nolonger available</div>        
    </div>
</template>
<script>
import BuyNowButton from '@/Modules/Ecommerce/BuyNow/index.vue';
import FreeTrailButton from '@/Modules/Ecommerce/BuyNow/freetrial.vue';
export default{
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        BuyNowButton,
        FreeTrailButton
    },
    data(){
        return{
            variation: 0,
            package: {},
            pricing: {}
        }
    },
    methods:{
        show(){
            let vm = this;
            let payload = {
                package: vm.data.package
            };
            axios.post(route('website.components.show', {component: 'cepackage'}), payload).then(response => {
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
            }).catch(error => {

            });
        },
        has_variation(batches){
            return (batches && batches.length > 1) ? true : false;
        }
    },
    watch:{
        "data.package": function(){
            if(this.data && this.data.package){
                this.show();
            }
        }
    },
    mounted(){
        this.show();
    }
}
</script>
