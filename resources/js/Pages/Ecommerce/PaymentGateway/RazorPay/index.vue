<template>
    <a href="javascript:void(0)" v-on:click="paynow" class="py-2.5 w-full block bg-rose-500 rounded-md text-center text-white text-[19px] font-semibold">PROCEED TO BUY</a>
</template>
<script>
export default{
    props:{
        summary: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{
        paynow(){
            this.$emit('proceed-to-pay', this.summary);
            // let vm = this;
            // axios.post(route('payment.order', {variation: vm.summary.variation}), vm.summary).then( (response) => {
            //     if(response && response.data){
            //         window.location.href = route('payment.process', {key: response.data.key, amount: response.data.amount, order: response.data.order});
            //     }
            // }).catch(error => {

            // });
        }
    },
    mounted(){

    }
}
</script>