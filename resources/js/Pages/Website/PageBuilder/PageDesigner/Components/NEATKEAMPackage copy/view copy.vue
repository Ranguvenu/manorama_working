<template>
    <div v-for="(price,key) in package.pricing" :key="key">
        {{key}}
        <!-- dkjsdjsd -->
        {{get_price(key)}}
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
            haspricing: false
        }
    },
    methods: {
        get_price(subjectid) {
            console.log(subjectid);
            console.log('fdsfsdfwwwwwwwwwwwwwwwwwww222')
            let vm = this;

            if(subjectid && subjectid.length){
                axios.get(route('ecommerce.pricing.show', { pricing: subjectid })).then((response) => {
                    vm.pricing = response.data.pricing;
                    console.log('sdfhsadfhs')
                    console.log(vm.pricing)
  
                    return vm.pricing
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
        // this.get_price();
    }
}
</script>


