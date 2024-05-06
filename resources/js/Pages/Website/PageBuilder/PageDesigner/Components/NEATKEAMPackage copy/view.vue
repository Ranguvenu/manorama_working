<template>
    <div v-if="package.is_published == 1">
        <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3" v-if="data && data.title">{{ data.title }}
        </div>
        <div class="bg-white mb-4" v-for="(price, indexs) in package.prices" >

            <div class="flex flex-wrap border-zinc-200 border rounded-[15px]">
                <div class="md:w-3/4 custom_md:w-3/5 w-full flex flex-wrap flex-col">
                    <div class="flex flex-wrap justify-between py-4 px-4 bg-white rounded-tl-2xl media_md:rounded-tr-2xl">
                        <div class="text-black text-xl font-semibold media_sm:mb-3">{{ data.name[indexs] ? data.name[indexs] : package.title}}</div>
                        <div class="bg-pink-100 rounded border border-dashed border-rose-500 px-4 py-1 inline-flex"
                            v-if="data.batchdate">
                            <div class="text-black text-base">Batch start date </div>
                            <div class="text-black text-base mx-1">: </div>
                            <div class="text-rose-500 text-base"> {{ data.batchdate }} </div>
                        </div>
                    </div>
                    <div class="bg-pink-50 py-1 px-8"><span
                            class="text-emerald-950 text-sm font-semibold leading-[21px]">Subjects</span></div>
                            <div class="flex flex-row flex-wrap p-8">
                                <div class="md:w-1/2 custom_md:w-full w-full flex items-center mb-5"
                                    v-for="(subject, index) in price" >
                                    <input v-if="subject.title" type="checkbox" :value="subject.id" :id="'subjectCheckbox' + index" v-model="checkedSubjects[index]" checked
                                        :disabled="!data.is_variable"
                                        class="w-5 h-5 text-rose-500 border-rose-500 rounded-[3px] focus:ring-rose-500 dark:focus:ring-rose-500 dark:ring-offset-rose-800 focus:ring-2 dark:bg-rose-700 dark:border-rose-600">
                                    <label :for="'subjectCheckbox' + index" class="ml-2 text-emerald-950 text-sm font-medium">{{ subject.title }}</label>
                                </div>
                            </div>                    
                        <div class="hidden md:block h-1 bg-slate-50"></div>
                    <div class="hidden md:flex justify-between rounded-bl-[11px] px-8 pt-5">
                        <div><a v-if="data && data.studyplan" :href="data.studyplan" class="text-center text-rose-500 text-sm font-medium leading-[21px]" download>Download Study
                                Plan</a></div>
                    </div>
                </div>
                <div
                    class="md:w-1/4 custom_md:w-2/5 w-full flex flex-wrap flex-col bg-purple-50 md:rounded-tr-2xl rounded-br-[11px] media_md:rounded-bl-2xl px-3 py-5">
                    <div class="text-indigo-800 text-lg font-semibold leading-[27px] py-2 mb-3">{{ package.title }}</div>
                    <template v-if="subjects && subjects.length">
                        <div v-if="price.haspricing">
                            <div class="flex items-center mb-1" v-if="pricing && price.prices[0].actual_price != price.prices[0].selling_price">
                                <div class="text-gray-600 text-base line-through leading-[21px] mr-2">₹ {{ price.prices[0].actual_price }}
                                </div>
                                <div class="text-green-600 text-base font-semibold mr-2"
                                    v-if="calculate_discount(price.prices[0].actual_price, price.prices[0].selling_price)">({{
                                        calculate_discount(price.prices[0].actual_price, price.prices[0].selling_price) }}%)</div>
                            </div>
                            <div class="flex items-center mb-6" v-if="pricing && price.prices[0].actual_price">
                                <div class="text-zinc-800 text-[32px] font-bold mr-1">₹ {{ price.prices[0].selling_price }}/-</div>
                                <div class="text-black text-xl font-medium">Only</div>
                            </div>
                            <div v-if="!price.has_purchased_variation">
                                <div class="w-full flex justify-center rounded-md mb-3">
                                    <BuyNowButton :packages="package" :variation="price.variation" :hasvariation="false" :batches="price.batches" />
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
                                    <FreeTrailButton :variation="price.variation" :hasvariation="false" :batches="price.batches"
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
            checkedSubjects: [],
            value: 0,
        }
    },
    methods: {
        show() {
            let vm = this;
            let payload = {
                package: vm.data.package
            };
            console.log('payload:', this.data.name);
            axios.post(route('website.components.show', { component: 'package' }), payload).then(response => {
                vm.package = response.data;
                console.log("checkinfgg", vm.package);

                if (vm.package && vm.package.subjects) {
                    vm.subjects = Array.from(new Set(vm.package.subjects.map(subject => subject.id)));
                    console.log('showsubjects1:', vm.subjects);

                    Object.keys(vm.package.prices).forEach(key => {
                        vm.update_pricing(key);
                    });
                }
            }).catch(error => {

            });
        },
        update_pricing(variation) {
            let vm = this;
            if(variation && variation.length){
                axios.get(route('ecommerce.pricing.show', { pricing: variation })).then((response) => {
                    vm.pricing = response.data.pricing;
                    vm.package.prices[variation].has_purchased_variation = response.data.has_purchased_variation
                    vm.package.prices[variation].haspricing = true;
                    vm.package.prices[variation].variation = variation;
                    vm.package.prices[variation].batches = response.data.batches;
                }).catch(error => {

                });
            }
        },
        calculate_discount(actual, selling) {
            return Math.round(((actual - selling) / actual) * 100, 2);
        },
        is_disabled(disabled) {
            return disabled;
            console.log(this.subjects.length);
            if (!disabled) {
                return !disabled;
            }
            return (this.subjects && this.subjects.length == 1) ? true : false;
        },

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


