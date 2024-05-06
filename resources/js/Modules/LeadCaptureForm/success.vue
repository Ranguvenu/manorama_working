<template>
    <div>
        <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-12 mb-8">
                <div class="text-center m-auto w-full mt-5 mb-2">
                    <SuccessIcon class="m-auto"/>
                </div>
                <div class="text-zinc-800 text-[25px] font-semibold text-center leading-[35px]">Thanks for sharing the details.</div>
                <div class="text-gray-600 text-[15px] mt-2 text-center">Our academic counsellor will call you soon</div>
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
        },
        isloading: {
            type: Boolean,
            default: false
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
