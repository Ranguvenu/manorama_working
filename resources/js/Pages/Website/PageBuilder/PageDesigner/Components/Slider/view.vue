<template>
    <div class="text-zinc-800 text-[22px] font-semibold mb-4">{{ data.title }}</div>
    <Carousel :items-to-show="1" :transition="500" itemsToScroll="3" :wrap-around="true">
        <Slide class="flex flex-col rounded-[11px] mt-2" v-for="(item, index) in data.items">
            <div class="carousel__item">
                <img style="width: inherit; max-height: 300px;" :src="item.image"
                    class="rounded-xl" />
            </div>
        </Slide>
        <template #addons>
            <Pagination />
        </template>
    </Carousel>
</template>
<script>
import { defineComponent } from 'vue';
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';

export default defineComponent({
    name: 'Basic',
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    props: {
        data: {
            type: Object,
            required: true
        }
    },
})
</script>
<style>
.carousel__slide {
    padding-top: 10px;
    padding-inline: 10px;
}
</style>
  
