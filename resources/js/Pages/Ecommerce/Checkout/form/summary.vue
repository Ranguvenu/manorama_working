<template>
    <div class="bg-white rounded border-b-4 border-neutral-200">
        <div class="text-zinc-800 text-base border border-b-1 border-gray-200 border-t-0 border-x-0 font-semibold ps-5 pt-3 pb-3">Summary</div>
        <div class="bg-zinc-100 rounded-md py-3 px-4 mx-5 my-4">
            <div class="mb-6">
                <div class="text-gray-600 text-sm">Course</div>
                <div class="text-black text-sm font-medium">{{ summary.course }}</div>
            </div>
            <div class="mb-6">
                <div class="text-gray-600 text-sm">Subjects</div>
                <div class="flex flex-wrap text-black text-sm font-medium">
                    <div class="me-3" v-for="(subject, index) in summary.subjects">{{ subject }}</div>
                </div>
            </div>
            <div class="mb-6">
                <div class="text-gray-600 text-sm">Valid Till</div>
                <div class="text-black text-sm font-medium" v-if="!summary.trial"> {{ summary.validity }} <span v-if="summary && summary.package && (summary.package.validity_type == 'days')">Days from the date of purchase</span></div>
                <div class="text-black text-sm font-medium" v-if="summary.trial"> {{ summary.trial }} Days</div>
            </div>
        </div>
        <CouponCode class="mx-5" :package="summary.package.id" @apply="apply_coupon" v-if="summary && summary.package && !summary.trial"/> 
        <div class="mx-5 py-4" v-if="!summary.trial">
            <div class="border-b border-gray-200 text-zinc-800 text-base font-semibold pb-2.5">Payment Summary</div>
            <div class="flex flex-col my-4">
                <div class="flex flex-wrap justify-between items-center mb-3">
                    <div class="text-gray-600 text-md">Actual Price</div>
                    <div class="text-zinc-800 text-md font-medium"><span>₹</span> {{ summary.actual_price }}</div>
                </div>
                <div class="flex flex-wrap justify-between items-center mb-3">
                    <div class="text-gray-600 text-md">Offer Price </div>
                    <div class="text-zinc-800 text-md font-medium"><span>₹</span> {{ summary.selling_price }}</div>
                </div>
                <div class="flex flex-wrap justify-between items-center mb-3" v-if="summary && summary.discount">
                    <div class="text-gray-600 text-md">Discount</div>
                    <div class="text-center text-green-500 text-md font-medium"><span>- ₹</span> {{ summary.discount }}</div>
                </div>
                <div class="flex flex-wrap justify-between items-center mb-3" v-if="summary && summary.delivery">
                    <div class="text-gray-600 text-md">Delivery Charges</div>
                    <div class="text-zinc-800 text-md font-medium"><span>- ₹</span> {{ summary.delivery }}</div>
                </div>
                <div class="flex flex-wrap justify-between items-center mb-3" v-if="summary && summary.coupon_discount">
                    <div class="text-gray-600 text-md">Coupon Discount</div>
                    <div class="text-center text-green-500 text-md font-medium"><span>- ₹</span> {{ summary.coupon_discount }}</div>
                </div>
            </div>
            <div class="flex flex-wrap justify-between items-center border border-x-0 border-gray-200 py-5" v-if="summary">
                <div class="text-zinc-800 text-base font-semibold">Total Amount</div>
                <div class="text-black text-base font-medium"><span>₹</span> {{ summary.total }}</div>
            </div>
            <div class="py-3">
                <p class="text-black text-[13px] font-light	leading-snug"><span>Please read and understand </span><span class="text-rose-500">terms and conditions</span><span> and </span><span class="text-rose-500">Privacy Policy </span><span>of Manorama Horizon and hereby give your consent to Manorama Horizon and its authorized personnel to contact you over your registered mobile number and/or email.</span></p>
            </div>
            <PaymentGateway :summary="summary" v-if="summary && summary.variation" @proceed-to-pay="paynow"/>
        </div>
        <div class="mx-5 py-4" v-if="summary.trial">
            <FreeTrialSubscription :summary="summary" @get-free-trial="get_free_trial" v-if="summary && summary.variation"/>
        </div>
    </div>
</template>
<script>
import CouponCode from './coupon.vue';
import PaymentGateway from '@/Pages/Ecommerce/PaymentGateway/index.vue';
import FreeTrialSubscription from '@/Pages/Ecommerce/FreeTrial/index.vue';
export default{
    components:{
        CouponCode,
        PaymentGateway,
        FreeTrialSubscription
    },
    props:{
        summary: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            coupon: {
                
            }
        }
    },
    methods: {
        paynow(summary){
            this.$emit('proceed-to-pay', summary);
        },
        get_free_trial(summary){
            this.$emit('get-free-trial', summary);
        },
        apply_coupon(coupon){
            this.$emit('apply-coupon', coupon);
        }
    },
    mounted(){
    }
}
</script>
