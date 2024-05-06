<template>
    <template v-if="summary && !summary.has_purchased_variation">
        <RazorPay :summary="summary" @proceed-to-pay="paynow"/>
    </template>
    <template v-else>
        <div class="bg-rose-100 text-primary p-2 border border-rose-200 rounded text-center">You have already purchased this package</div>
    </template>
</template>
<script>
import RazorPay from './RazorPay/index.vue';
export default{
    props:{
        summary: {
            type: Object,
            required: true
        }
    },
    components:{
        RazorPay
    },
    data(){
        return {

        }
    },
    methods:{
        paynow(summary){
            // console.log('at proceed to payssadbjsdhsad22')
            // console.log(summary)
            // return;
            this.$emit('proceed-to-pay', summary);
        }
    },
    mounted(){

    }
}
</script>
