<template>
    <div class="bg_radial_white_pink">
        <div class="sm:max-w-screen-2xl mx-auto md:px-16 px-6 py-6 mb-8">
            <div class="flow-root mb-3">
                <div class="float-left">
                    <div class="text-zinc-800 text-xl font-semibold">Payment</div>
                </div>
                <div class="float-right">
                    <a :href="get_back_url()" class="text-blue-800 text-base">Back</a>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-3/5 pe-3">
                    <BasicInformation :form="form" :errors="errors"/>
                    <AddressInformation :form="form" :options="options" :errors="errors"/>
                </div>
                <div class="w-full md:w-2/5 md:ps-3">
                    <OrderSummary :summary="summary" @proceed-to-pay="paynow" @get-free-trial="paynow" @apply-coupon="apply_coupon"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import BasicInformation from './basic.vue';
import AddressInformation from './address.vue';
import OrderSummary from './summary.vue';

export default{
    components:{
        BasicInformation,
        AddressInformation,
        OrderSummary
    },
    data(){
        return{
            form: this.initialize(),
            options: {
                countries: [],
                states: []
            },
            summary: {},
            coupon: {},
            errors: []
        }
    },
    methods:{
        initialize(){
            return {
                firstname: '',
                lastname: '',
                email: '',
                phone_number: '',
                address: '',
                address2: '',
                country: '',
                state: '',
                city: '',
                pincode: ''
            }
        },
        get_summary(refresh = true){
            let vm = this;
            let variation = vm.$store.getters.variation;
            let payload = {
                coupon: vm.coupon,
                batch: variation.batch,
                trial: variation.trial
            };
            axios.post(route('checkout.summary', {variation: variation.price}), payload).then( (response) => {
                vm.summary = response.data.data;
                if(refresh){
                    vm.form = this.$merge_objects(vm.form, response.data.form);
                    vm.options = response.data.options;
                }
            }).catch(error => {

            });
        },
        apply_coupon(coupon){
            this.coupon = coupon;
            this.get_summary(false);
        },
        paynow(summary){
            let vm = this;
            let payload = {
                profile: vm.form,
                summary: vm.summary,
                coupon: vm.coupon,
                trial: vm.summary.trial,
            }
            axios.post(route('payment.order', {variation: summary.variation}), payload).then( (response) => {
                if(response && response.data && response.data.amount){
                    window.location.href = route('payment.process', {key: response.data.key, amount: response.data.amount, order: response.data.order});
                }else if(response && response.data && !response.data.amount){
                    window.location.href = route('checkout.complete', {package: response.data.package, order: response.data.order_key, status: 'success'});
                }else{
                    console.log("Order Failed");
                }
            }).catch(error => {
                vm.errors = error.response.data.errors;
            });
        },
        get_back_url(){
            return (this.$page.props && this.$page.props.previous) ? this.$page.props.previous : '/'; 
        }
    },
    mounted(){
        this.get_summary();
    }
}
</script>
