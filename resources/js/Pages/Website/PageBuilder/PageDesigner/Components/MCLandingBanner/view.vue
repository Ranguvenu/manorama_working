<template>
    <ul class="flex nav_list mb-2 flex-wrap">
        <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
            <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm"
                :class="{ 'active': !breadcrump.active }">{{ breadcrump.title }}</a>
        </li>
    </ul>
    <div class="flex items-center justify-between mcviewbanner">
        <div class="flex flex-col md:w-1/2 w-full mt-4 md:pr-6">
            <div>
                <span v-bind:style="get_color(data.font_color_primary)" class="text-2xl font-semibold leading-[32px]">{{ data.primary_title }}</span>
                &nbsp;
                <span v-bind:style="get_color(data.font_color_secondary)" class="mb-4 text-2xl font-semibold leading-[32px]">{{ data.secondary_title }}</span>
            </div>
            <div class="text-gray-600 text-base leading-relaxed">{{ data.caption }}</div>
            <div class="flex items-center my-3" v-if="summary && summary.pricing && data.package && data">
                <div class="text-zinc-800 text-[13px]" v-if="summary.pricing.actual_price || summary.pricing.selling_price">Fee</div>
                <div class="mx-3 text-xl text-neutral-400 font-semibold" v-if="summary.pricing.actual_price && summary.pricing.actual_price != summary.pricing.selling_price">
                    <span class="mr-1">₹</span>
                    <span class="line-through">{{ summary.pricing.actual_price }}</span>
                </div>
                <div class="mx-1" v-if="summary.pricing.selling_price">
                    <span class="mr-1">₹</span>
                    <span class="text-gray-600 text-zinc-800 text-xl font-semibold ">{{ summary.pricing.selling_price }}</span>
                </div>

                <div  class="mx-1 text-green-600 text-base font-semibold" v-if="summary.pricing.actual_price != summary.pricing.selling_price">
                    {{
                      (((summary.pricing.actual_price - summary.pricing.selling_price) / summary.pricing.actual_price) * 100) === 0
                      ? ''
                      : ((summary.pricing.actual_price - summary.pricing.selling_price) / summary.pricing.actual_price * 100).toFixed(1) + '% off'
                    }}
                  </div>
                                  <div class="mx-1 flex items-center" v-if="summary && summary.rating">
                    <div class="text-zinc-800 text-base font-medium mr-2">{{ summary.rating }}</div>
                    <vue3-star-ratings starSize="16" :disableClick="true" starColor="#FFC107" inactiveColor="#d6d6d6" v-model="summary.rating"/>
                </div>
            </div>
            <div class="my-4 inline-flex">
                <ActionButtonsView :buttons="data.buttons" />
            </div>
            <div class="flex mb-6">
                <img v-for="(logo, index) in data.logos" class="mr-4" :src="logo.logo">
            </div>
        </div>
        <div class="md:flex md:w-1/2 hidden items-center px-6 justify-end">
            <div>
                <Carousel class="justify-end items-center rounded-[15px]">
                    <Slide v-for="(image, slide) in data.slider.images" :key="slide">
                        <div class="carousel__item"><img :src="image.image"></div>
                    </Slide>
                    <template #addons>
                        <Navigation v-if="data.slider.navigation" />
                        <Pagination v-if="data.slider.pagination" />
                    </template>
                </Carousel>
            </div>
        </div>
    </div>
</template>
<script>
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';
import vue3StarRatings from "vue3-star-ratings";

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
        ActionButtonsView,
        "vue3-star-ratings": vue3StarRatings
    },
    data() {
        return {
            summary: {
                pricing: {},
                rating: 0
            }
        }
    },
    methods: {
        show(){
            let vm = this;
            if(!(vm.data && vm.data.package)){
                return;
            }
            let payload = {
                package: vm.data.package
            };
            axios.post(route('website.components.show', {component: 'mc-landing-banner'}), payload).then(response => {
                vm.summary = response.data;
            }).catch(error => {

            });
        },
        get_color(color){
            let returns = {};
            returns.color = color;
            return returns;
        }
    },
    mounted() {
        this.show();
    },
    computed: {

    }
}
</script>
