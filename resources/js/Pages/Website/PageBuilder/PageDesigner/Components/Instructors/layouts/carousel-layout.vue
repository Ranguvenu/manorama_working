<template>
    <div class="flex items-center justify-between">
        <div :class="{
            'text-zinc-800 text-center text-[22px] sm:text-[25px] font-semibold': data.title_alignment === 'center',
            'text-zinc-800 text-left text-[22px] sm:text-[25px] font-semibold': data.title_alignment === 'left',
            'text-zinc-800 text-right text-[22px] sm:text-[25px] font-semibold': data.title_alignment === 'right'
            }">
            <div class="text-zinc-800 text-[22px] sm:text-[25px] font-semibold mb-3">{{ data.title }}</div>
        </div>

    </div>
    <Carousel :autoplay="1000" :breakpoints="breakpoints" :wrap-around="true">
        <Slide class="flex !items-start !justify-start flex-wrap md:w-1/4 sm:w-1/2 w-full pr-4 mb-4 !ps-0 !pe-4" v-for="(item, index) in data.items">
            <div class="carousel__item h-full !justify-start flex flex-col w-full rounded-[22px] border border-zinc-200 p-4 bg-white">
                <div class="mb-4 relative w-full h-[180px] rounded-[14px] bg-cover bg-no-repeat bg-center"  :style="{'background-image': 'url(' + item.instructor_image + ')'}">
                    <!-- <img :src="item.instructor_image" :alt="item.name"   /> -->
                </div>
                <div class="text-center text-zinc-800 text-base font-semibold">{{ item.name }}</div>
                <div class="text-center mb-2">
                    <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">{{item.experience}} </span>
                </div>
                <div class="text-center text-gray-600 text-[13px] mb-2 line-clamp-2" v-html="item.description"></div>
                <div class="text-center text-gray-600 text-[13px] font-semibold">{{ item.organization }}</div>
            </div>
        </Slide>
        <template #addons>
            <Navigation v-if="data && data.navigation"/>
            <Pagination v-if="data && data.pagination"/>
        </template>
    </Carousel>
    <div class="flex items-center justify-end">
        <div class="text-blue-800 text-md font-medium end-5 mb-4 mt-6 text-right">
            <a v-if="data && data.view_all && data.view_all.label" class="text-end justify-end me-4" :href="data.view_all.url">{{data.view_all.label}}
                <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png" /></span>
            </a>
        </div>
    </div>
</template>
<script>
import { defineComponent } from 'vue';
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
export default defineComponent ({
    name: 'WrapAround',
    components:{
        Carousel,
        Navigation,
        Pagination,
        Slide
    },
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    data:() => ({
        // breakpoints are mobile first
        // any settings not specified will fallback to the carousel settings
        breakpoints: {
            // 300 and up
            300: {
                itemsToShow: 1.2,
                snapAlign: 'left',
                itemsToScroll: 1
            },
            640: {
                itemsToShow: 2.2,
                snapAlign: 'left',
                itemsToScroll: 1
            },
            // 768 and up
            768: {
                itemsToShow: 3.2,
                snapAlign: 'start',
                itemsToScroll: 2
            },
            // 1024 and up
            1024: {
                itemsToShow: 4,
                snapAlign: 'start',
                itemsToScroll: 2

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
