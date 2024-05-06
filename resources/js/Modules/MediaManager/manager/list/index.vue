<template>
    <template v-if="media.data && media.data.length">
        <div class="max-h-80 overflow-y-auto">
            <div class="grid grid-cols-12 gap-x-6 gap-y-8 md:grid-cols-5 sm:grid-cols-3">
                <div class="" v-for="(data, index) in media.data" v-on:click="selected(data)">
                    <div class="max-w-sm rounded overflow-hidden border image-fitted-container h-32 shadow relative" :class="{'media-selected border-primary border-2': is_current(data.id)}">
                        <CheckCircleIcon v-if="is_current(data.id)" class="z-10 w-6 h-6 bg-white rounded-full shadow p-0 text-primary absolute right-0" />
                        <component v-bind:is="data.media_type" :data="data"/>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" v-if="media && media.meta && (media.meta.last_page > media.meta.current_page)">
                <ButtonOutline size="sm" v-on:click="$emit('load-more', media.meta.current_page+1)">View More</ButtonOutline>
            </div>
        </div>
    </template>
    <template v-else>
        <div class="bg-rose-100 border border-rose-300 rounded w-full p-3 text-center">
            No Media Items Found
        </div>
    </template>
</template>
<script>
import ImageCard from "./images.vue";
import DefaultCard from "./default.vue";
import VideoCard from "./videos.vue";
import PDFCard from "./pdfs.vue";
import { CheckCircleIcon } from "@heroicons/vue/24/solid";
import ButtonOutline from '@/Components/ButtonOutline.vue';

export default{
    components:{
        "images": ImageCard,
        "default": DefaultCard,
        "videos": VideoCard,
        "pdfs": PDFCard,
        "CheckCircleIcon":CheckCircleIcon,
        ButtonOutline
    },
    props:{
        media: {
            type: Object,
            required: true
        },
        items: {
            type: Array,
            required: true
        },
    },
    emits: ['selected'],
    data(){
        return {
            current: {}
        }
    },
    methods:{
        is_current(id){
            let index = this.items.findIndex( x => x.id == id);
            return (index > -1) ? true : false;
        },
        selected(data){
            this.current = data;
            this.$emit('selected', data)
        }
    },
    mounted(){
    }
}
</script>
