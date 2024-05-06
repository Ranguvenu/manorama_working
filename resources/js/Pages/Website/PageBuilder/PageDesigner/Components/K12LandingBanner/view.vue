<template>
    <ul class="flex nav_list mb-2 flex-wrap">
        <li class="flex  items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
            <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
        </li>
    </ul>
    <div class="flex flex-wrap items-center justify-between">
        <div class="flex flex-wrap flex-col md:w-1/2 w-full">
            <div class="text-gray-600 text-base mb-1">{{data.category}}</div>
            <div class="text-zinc-800 text-4xl font-semibold leading-[44px] mb-4">{{data.title}}</div>
            <div class="text-zinc-800 text-base leading-relaxed mb-4">{{data.caption}}</div>
            <div class="mb-4 flex flex-wrap">
                <ActionButtonsView :buttons="data.buttons"/>
            </div>
            <div class="flex items-center" v-if="data.youtube">
                <div class="mr-2"><img src="/images/product/youtube.png"/></div>
                <div class="text-black text-sm font-medium leading-[25px]"><a :href="data.youtube">View us on youtube</a></div>
            </div>
        </div>
        <div class="hidden md:flex flex-col md:w-1/2 w-full justify-center items-center">
            <img :src="data.thumbnail" :alt="data.title"/>
        </div>
    </div>
    <div class="flex md:justify-between md:mt-12 mt-4 overflow-x-scroll no-scrollbar touch-auto">
        <div class="flex items-center shrink-0 flex-col mr-2 w-[120px] md:w-[150px]" v-for="(feature, index) in data.features">
            <div class="w-[50px] h-[50px] mb-4">
                <img  :src="feature.icon"/>
            </div>
            <div class="text-black text-sm text-center font-medium leading-tight">{{ feature.title }}</div>
        </div>
    </div>
</template>
<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
    },
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        ActionButtonsView
    },
    data() {
        return {

        }
    },
    methods: {
        get_color(color){
            let returns = {};
            returns.color = color;
            return returns;
        }
    },
    mounted() {
    },
    computed: {

    }
}
</script>
