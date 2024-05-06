<template>
    <div class="flex flex-col justify-center mb-12">
        <div class="text-center text-zinc-800 text-[26px] font-semibold">{{data.title}}</div>
        <div class="text-center text-gray-600 text-base">{{data.caption}}</div>
    </div>
    <!-- gap-8 grid grid-cols-1 grid-flow-row-dense custom_md:colums-2 custom_md:grid-cols-2 lg:columns-3 lg:grid-cols-3 columns-1 -->
    <Carousel :breakpoints="breakpoints" class="w-full">
        <Slide class="w-full" v-for="(testimonial, index) in testimonials.data">
            <div class="flex flex-col  rounded-[9px] border mt-8 w-full " :class="{'bg-rose-100': index % 2 === 0, 'bg-yellow-50': index % 2 !== 0 }">
                <div class="bg-white rounded-[9px] border -mx-[1px]flex-1 flex flex-col-reverse items-center md:items-start md:flex-col border-zinc-200 relative px-4 py-6">
                    <div class="w-[42px] h-[42px] bg-red-300 rounded-full flex items-center justify-center absolute left-[10px] top-[-25px] ">
                        <img src="/images/homepage/left-quotes.png"/>
                    </div>
                    <div class="h-[180px] overflow-hidden">
                        <div class="text-gray-600 text-base mb-7 text-center md:text-start mt-2 " v-if="testimonial.testimonial_type == 1">
                            <div class="ck_content" v-html="testimonial.testimonial"></div>
                        </div>

                        <div class="text-gray-600 text-base mb-7 text-center md:text-start mt-2 " v-if="testimonial.testimonial_type == 2">
                            <video height="240" class="rounded-lg" controls>
                                <source :src="testimonial.testimonial" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center md:justify-start">
                        <div  v-if = "testimonial.profileimage" class="md:mr-4"><img class="w-[59px] h-[59px] rounded-full" :src=testimonial.profileimage /></div>
                        <div  v-else class="md:mr-4"> <div class="w-[59px] h-[59px] rounded-full bg-rose-100 text-blue-800 text-center p-3 text-2xl">{{ testimonial.profile[0] }}</div> </div>
                        <div class="flex flex-col mt-3 md:mt-0">
                            <div class="text-zinc-800 text-base text-center md:text-left font-semibold">{{ testimonial.name }}</div>
                            <div class="text-gray-600 text-sm text-center md:text-left">{{ testimonial.profile }}</div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 hidden md:block" v-if="testimonial.package"><div class="text-black text-sm font-medium">{{ testimonial.package }}</div>
                </div>
            </div>
        </Slide>
        <template #addons>
            <Navigation v-if="data && data.navigation"/>
            <Pagination v-if="data && data.pagination"/>
        </template>
    </Carousel>
    <div class="text-blue-800 text-md font-medium flex justify-center mt-8 mb-6" v-if="data.view_all"><a :href="data.view_all">View all testimonials <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a></div>

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
            Slide,
            defineComponent
        },
        props:{
            data:{
                type: Object,
                required: true
            },
            testimonials:{
                type: Object,
                required: false
            }
        },
        data:() => ({
            // breakpoints are mobile first
            // any settings not specified will fallback to the carousel settings
            breakpoints: {
                // 640 and up
                640: {
                    itemsToShow: 2.1,
                    snapAlign: 'left',
                    itemsToScroll: 1
                },
                // 768 and up
                768: {
                    itemsToShow: 3.1,
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
    })
</script>

