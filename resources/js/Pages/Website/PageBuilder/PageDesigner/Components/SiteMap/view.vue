<template>
        <ul class="flex nav_list mb-1">
            <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
                <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
            </li>
        </ul>
        <div class="text-black text-[25px] font-semibold">{{data.title}}</div>
        <div class="py-3 my-6">
            <div class="inline-block w-full columns-1 md:columns-2 lg:columns-3">
                <div v-for="(item, index) in data.items" :key="index" class="inline-block w-full">
                    <div class="flex flex-col flex-row bg-white rounded-[11px] border border-gray-200 mb-6">
                        <div class="bg-neutral-50 rounded-tl-[11px] rounded-tr-[11px] py-6 px-4">
                            <div class="text-black text-base font-semibold">{{ item.title }}</div>
                        </div>
                        <div class="flex flex-col py-8 px-4">
                            <div v-for="(link, index) in item.links" :key="index" class="my-1">
                                <a :href="link.url" class="text-black text-base">{{ link.title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

export default defineComponent ({
    name: 'Basic',
    props:{
        data:{
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
    data(){
        return{
        }
    },
    methods:{
    },
    mounted(){
    },
    computed: {

    }
})
</script>
