<template>
    <div class="flex items-center justify-between mb-6">
        <div class="text-zinc-800 text-[25px] font-semibold">{{data.title}}</div>
    </div>
    <Carousel v-bind="settings" :breakpoints="breakpoints"  class="flex flex-wrap overflow-hidden">
        <Slide class="lg:w-1/5 flex-shrink-0 md:w-1/4 sm:w-1/2 w-full pr-4 mb-4 country_carousel_container" v-for="(item, index) in data.items">
            <div class="flex flex-col">
                <div class="mb-4"><img class="rounded-[17px]" :src="item.image"/></div>
                <div class="flex items-center">
                    <img class="mr-2" :src="item.icon"/>
                    <div class="text-zinc-800 text-base font-medium leading-relaxed">{{ item.title }}</div>
                </div>
            </div>
        </Slide>
        <template #addons>
            <div class="w-full"><Pagination v-if="data.pagination"/></div>
            <Navigation v-if="data.navigation"/>
        </template>
    </Carousel>
</template>
<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Breakpoints',
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
    },
    data:() => ({
        settings: {
            itemsToShow: 1,
            snapAlign: 'center',
            itemsToScroll: '1'
        },
        breakpoints: {
            300: {
                itemsToShow: 1.2,
                snapAlign: 'left',
                itemsToScroll: '1'
            },
            640: {
                itemsToShow: 2.2,
                snapAlign: 'left',
                itemsToScroll: '1'
            },
            // 768 and up
            768: {
                itemsToShow: 3.2,
                snapAlign: 'start',
                itemsToScroll: '2'
            },
            // 1024 and up
            1024: {
                itemsToShow: 5,
                snapAlign: 'start',
                itemsToScroll: '5'

            }
        },
    }),
    methods:{
        
    },
    computed:{
        
    },
    mounted(){

    }
});
</script>
