<template>
    <div>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-12 mb-8">
                <div class="text-center m-auto w-full mt-5 mb-2">
                    <SuccessIcon class="m-auto"/>
                </div>
                <div class="text-xl text-zinc-700 font-bold text-center">Your Account is Created Successfully</div>
                <div class="text-sm text-zinc-600 mt-4 text-center">Please login using your credentials</div>
                <div class="text-center pt-8">
                    <a :href="route('dashboard')" class="bg-primary text-white py-2 px-5 w-full rounded-lg text-lg">Login</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SuccessIcon from '@/SvgIcons/SuccessIcon.vue';
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
        errors:{
            type: Object,
            required: false
        }
    },
    components:{
        SuccessIcon
    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>