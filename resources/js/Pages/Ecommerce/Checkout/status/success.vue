<template>
    <div class="bg_radial_white_pink">
        <div class="sm:max-w-6xl max-w-screen-2xl mx-auto w-full px-16 py-12">
            <div class="flex flex-col justify-center items-center">
                <div class="mx-auto mb-4"><img src="/images/check-success.png" alt="Successfull"/></div>
                <div v-if="response.status != 6">
                    <div class="text-center text-zinc-800 text-[29px] font-semibold leading-[35px] mb-6">Welcome Aboard! Your Course Purchase Was a Success!</div>
                    <div class="text-center text-black text-base leading-relaxed mb-6">We're happy to inform you that your purchase of the package was successful. Thank you for choosing Manorama Horizon! Get ready to embark on an exciting journey filled with enriching experiences. Welcome aboard!</div>
                </div>
                <div v-else>
                    <div class="text-center text-zinc-800 text-[29px] font-semibold leading-[35px] mb-6">Congratulations on Your Subscription to free trial!</div>
                    <div class="text-center text-black text-base leading-relaxed mb-6">High five! Your free trial subscription the package has been successful, and we're thrilled to have you onboard! Get ready for an exciting journey filled with endless possibilities and enriching experiences.</div>
                </div>
                <div class="sm:max-w-6xl mx-auto w-full">
                    <TransactionDetails :response="response"/>
                    <div class="my-4 flex justify-end">
                        <a :href="route('checkout.profile')" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TransactionDetails from './details/index.vue';
export default {
    components:{
        TransactionDetails
    },
    props:{
        response: {
            type: Object,
            required: true
        }
    },  
    data(){
        return {

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>
