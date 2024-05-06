<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useStore } from 'vuex'
const store = useStore();
const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});

const redirect_to_home = () => {
    store.dispatch('clear_variations');
    window.location.href = route('login');
};
</script>
<template>
    <Head title="Checkout" />
    <WebsiteLayout>
        <div class="bg_radial_white_pink">
            <div class="sm:max-w-6xl max-w-screen-2xl mx-auto w-full px-16 py-12">
                <div class="flex flex-col justify-center items-center">
                    <div class="mx-auto mb-4"><img src="/images/check-success.png" alt="Successfull"/></div>
                    <div class="text-center text-zinc-800 text-[29px] font-semibold leading-[35px] mb-6">Your Order is Cancelled</div>
                    <div class="text-center text-black text-base leading-relaxed mb-6">We regret to go you back, If you have cancelled this accidentally you can click on checkout or click on home to explore our other products.</div>
                    <div class="sm:max-w-6xl mx-auto w-full">
                        <div class="my-4 flex justify-end">
                            <a :href="route('checkout.index')" class="px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium">Proceed to Checkout</a>
                            <a href="javascript:void(0)" v-on:click="redirect_to_home" class="ms-2 px-[18px] py-2.5 border border-rose-600 rounded-[5px] text-rose-600 font-medium">Go To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</WebsiteLayout>
</template>
