<template>
    <div class="flex flex-col justify-center">
        <div class="flex justify-center mb-2"><img src="/images/homepage/emoji-happy.png" /></div>
        <div class="text-center text-black text-[26px] font-semibold leading-[35px] mb-3">{{ data.title }}</div>
        <div class="flex justify-center mb-6">
            <div class="w-[544px] text-center text-neutral-900 text-base text-[14px]">{{ data.caption }}</div>
        </div>
        <EnquiryForm :label="data.button_title" />
    </div>
</template>
<script>
import EnquiryForm from '@/Modules/EnquiryForm/index.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {
        EnquiryForm
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
