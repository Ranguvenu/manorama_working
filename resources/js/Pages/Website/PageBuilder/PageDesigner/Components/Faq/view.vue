<template>
    <div class="flex flex-col items-center mb-3">
        <div class="text-zinc-800 text-[26px] font-semibold leading-[35px] mb-3">{{ data.title }}</div>
        <div class="md:w-3/4 custom_md:w-full md:mx-auto w-full">
            <AutoLayout :data="data" v-if="data.mode == 1"/>
            <ManualLayout :data="data" v-if="data.mode == 0"/>
        </div>
    </div>
</template>
<script>
import AutoLayout from './layout/auto/index.vue';
import ManualLayout from './layout/manual/index.vue';

export default {
    components:{
        AutoLayout,
        ManualLayout
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    methods: {

    },
    mounted(){

    }
};
</script>

