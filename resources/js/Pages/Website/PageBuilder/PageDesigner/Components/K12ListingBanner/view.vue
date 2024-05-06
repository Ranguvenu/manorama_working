<template>
    <ul class="flex nav_list mb-3 flex-wrap">
        <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
            <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
        </li>
    </ul>
    <div class="flex flex-wrap items-center justify-between">
        <div class="flex flex-wrap flex-col md:w-1/2 w-full">
            <div class="mb-4"><span class="text-zinc-800 text-2xl xl:text-3xl font-semibold" v-bind:style="primary_text_color(data.headings.primary.color)">{{data.headings.primary.text}}</span> <span v-bind:style="secondary_text_color(data.headings.secondary.color)" class="text-rose-500 text-3xl font-semibold" >{{data.headings.secondary.text}} </span></div>
            <div class="text-gray-600 text-base mb-4">{{data.caption}}</div>
            <div class="mb-4 flex flex-wrap">
                <ActionButtonsView :buttons="data.buttons"/>
            </div>
        </div>
        <div class="hidden md:flex md:w-1/2 w-full flex-col justify-center items-center">
            <Carousel class="mb-4" :items-to-show="1" :transition="500" itemsToScroll="1">
                <Slide class="flex flex-col mr-12" v-for="(image, index) in data.slider.images" :key="slide">
                    <img :src="image.image" class="mb-4">
                </Slide>
                <template #addons>
                    <Navigation v-if="data.slider.navigation"/>
                    <Pagination v-if="data.slider.pagination"/>
                </template>
            </Carousel>
        </div>
    </div>
    <div class="flex items-center md:border border-zinc-200 justify-between overflow-x-scroll no-scrollbar touch-auto rounded-tl-[11px] rounded-tr-[11px] mt-6 -mx-4">
        <div class="flex md:border border-zinc-200 items-center px-4 py-4 w-1/4 media_lg:min-w-[250px] media_" v-for="(item, index) in data.stats.items">
            <div class="w-[46px] h-[46px] mr-2">
                <img  :src="item.icon" />
            </div>
            <div class="flex flex-col items-start inline-flex pl-3">
                <div class="flex">
                    <span class="text-[28px] font-semibold me-1" v-if="(item.display_operator == 'before')"> {{ item.operator }}</span>
                    <span class="text-[28px] font-semibold " ><AnimatedNumber :number="item.count" :edit="edit"/></span>
                    <span class="text-[28px] font-semibold ml-1"  v-if="(item.display_operator == 'after')"> {{ item.operator }}</span>
                </div>
                <div class="text-neutral-500 text-base">{{item.description}}</div>
            </div>
        </div>
    </div>
</template>
<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import { defineComponent } from 'vue'
import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';
import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';
import AnimatedNumber from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/AnimatedNumber/view.vue';

export default defineComponent({
    name: 'WrapAround',

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
        RequestCallbackButton,
        ActionButtonsView,
        AnimatedNumber
    },
    data() {
        return {

        }
    },
    methods: {
        primary_text_color(color){
            let returns = {};
            returns.color = color;
            return returns;
        },
        secondary_text_color(color){
            let returns = {};
            returns.color = color;
            return returns;
        }
    },
    mounted() {
    },
    computed: {

    }
});
</script>
