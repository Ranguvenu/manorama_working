<template>
    <div class="bg-info">
        <div class="flex flex-row flex-wrap items-center justify-between welcome-section bg-info">
            <div class="md:w-1/2 w-full flex-col items-start md:inline-flex hidden welcome-text md:pr-8">
                <div
                    class="custom_md:hidden origin-top-left w-[48.49px] h-[49.68px] relative strokes top-[14px] left-[-25px] md:mr-3">
                </div>
                <div class="mb-3">
                    <span class="text-[30px] md:text-[35px] md:leading-[43px] mr-2 leading-[35px] font-bold"
                        v-bind:style="get_color(data.font_color_primary)">{{ data.primary_title }} </span>
                    <span
                        class="text-[30px] md:text-[35px] md:leading-[43px] leading-[35px] font-bold" v-bind:style="get_color(data.font_color_secondary)">
                        {{ data.secondary_title }}</span>
                </div>
                <div class="text-gray-600 text-base mb-3">{{ data.caption }}</div>
                <div class="flex pt-5 mb-3">
                    <ActionButtonsView :buttons="data.buttons"/>
                </div>
            </div>
            <Carousel :items-to-show="1" class="md:w-1/2 w-full homebanner_slider" :transition="500" itemsToScroll="1">
                <Slide v-for="(item, index) in data.items"
                    class="fixed max-w-full md:p-4 bg-gradient-to-l from-red-100 via-fuchsia-100 to-indigo-50 rounded-[15px] flex items-center slider">
                    <div class="flex-col text-left items-start inline-flex slider-text md:pr-4">
                        <div class="text-left text-zinc-800 lg:text-[20px] text-[20px] font-semibold mb-3">
                            {{ item.cardtitle }}</div>
                        <div class="text-left text-gray-600 text-sm  mb-3 ck-content">{{ item.description }}</div>
                        <a v-if="item && item.button" :href="item.button.link" class="pb-2 text-left text-rose-500 text-[14px] md:text-[18px] font-semibold">{{ item.button.label }}</a>
                    </div>
                    <div class="banner_slide_image hidden md:block"><img :src="item.image" class="lg:max-w-[220px]"/></div>
                </Slide>
                <template #addons>
                    <Pagination/>
                </template>
            </Carousel>
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
