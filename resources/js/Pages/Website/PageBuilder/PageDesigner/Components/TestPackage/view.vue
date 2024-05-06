<template>
 <div v-if="package.is_published == 1">    
    <div class="text-zinc-800 text-[25px] font-semibold mb-6">{{data.title}}</div>
    <div class="rounded border-primary border bg-gray-50 p-5 ">
        <div class="rounded bg-white px-4 py-5 mb-3" v-for="(test, index) in data.tests">
            <h4 class="font-bold text-lg text-black mb-2">{{test.title}}</h4>
            <div class="flex flex-col md:flex-row md:items-center gap-2 md:justify-between">
                <h6 class="text-sm text-slate-500">Duration : {{test.duration}}, No of questions : {{test.questions}}, Marks:{{test.marks}}</h6>
                <h6 class="text-sm md:text-base text-slate-500 font-medium">{{test.dates}}</h6>
            </div>
        </div>
        <div class="rounded border flex-wrap  border-primary bg-purple-50 md:px-4 mb-3 flex items-center md:justify-between justify-center">
            <div class="pt-4 md:pt-0">
                <div class="flex items-center flex-wrap gap-2 pl-4 md:pl-0" v-if="pricing">
                    <div class="text-zinc-400 text-xl font-bold line-through" v-if="pricing && pricing.actual_price && pricing.actual_price != pricing.selling_price">Rs {{pricing.actual_price}} /-</div>
                    <div class="text-gray-800 text-xl "  v-if="pricing && pricing.selling_price"><span class="font-bold">Rs {{pricing.selling_price}}</span> <span class="font-regular text-base">/- Only</span></div>
                    <div class="text-green-600 text-sm font-semibold mt-1" v-if="calculate_discount(pricing.actual_price, pricing.selling_price)">({{
                                        calculate_discount(pricing.actual_price, pricing.selling_price) }}% OFF)</div>
                </div>
            </div>
            <div class="flex">
                <div v-if="!package.has_purchased" class="mt-4 mb-4">
                    <BuyNowButton  :packages="package" :variation="variation" :hasvariation="has_variation(package.batches)" :batches="package.batches"/>
                </div>
                <div v-else class="mt-4 mb-4">
                    <a class="w-full block bg-rose-500 rounded-lg py-2.5 px-5 text-zinc-100 text-base font-semibold text-center" :href="route('integrations.sso.login')">Go To Dashboard</a>
                </div>
            </div>
        </div>
        <div class="text-zinc-800  font-semibold">{{package.enrollments}} + Students are Enrolled</div>
    </div>
</div>
<div v-else class="bg-rose-200 p-2 my-2 rounded-lg text-center">
    <div>The package you are looking for is nolonger available</div>        
</div>
</template>
<script>
import BuyNowButton from '@/Modules/Ecommerce/BuyNow/index.vue';
import FreeTrailButton from '@/Modules/Ecommerce/BuyNow/freetrial.vue';
export default {
props: {
    data: {
        type: Object,
        required: true
    },
},
components: {
    BuyNowButton,
    FreeTrailButton
},
data() {
    return {
        variation: 0,
        package: {},
        pricing: {}
    }
},
methods: {
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
    },
    calculate_discount(actual, selling) {
        return Math.round(((actual - selling) / actual) * 100, 2);
    },
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
