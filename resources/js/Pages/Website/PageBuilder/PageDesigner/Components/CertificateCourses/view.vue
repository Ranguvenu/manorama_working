<template>
    <div class="cc_courses">
        <div :class="'flex mb-3 items-center md:justify-'+ data.title_alignment">
            <div class="text-center text-zinc-800 text-[22px] sm:text-[25px] font-semibold leading-[35px]">{{ data.title }}</div>
        </div>
        <div :class="'flex items-'+data.title_alignment + 'text-gray-600 text-base mb-6 justify-'+ data.title_alignment ">{{ data.caption }}</div>
        <div v-if="courses && courses.length">
            <div class="flex flex-wrap -mx-2">
                <div class="lg:w-1/4 md:w-1/3 sm:w-1/2 w-full mb-2 sm:mb-4 px-2" v-for="(course, index) in courses">
                    <div class="w-full sm:shadow border border-rose-500 sm:border-zinc-100 rounded-[10px] h-full">
                        <img class="rounded-tl-lg rounded-tr-lg w-full min-h-[150px] max-h-[150px] hidden sm:block object-cover"
                            :src="course.thumbnail" :alt="course.title" />
                        <div class="px-3 pt-4">
                            <h4 class="text-zinc-800 text-sm sm:text-base font-semibold pb-4 line-clamp-1 h-[26px]">{{ course.title }}</h4>
                            <h4 class="text-gray-400 text-sm sm:text-base pb-4 line-clamp-1 h-[26px] mb-2 ">Starting {{ formatDate(course.enrolment_starts) }}</h4>
                            <div class="flex items-center pb-4" v-if="course.rating && course.rating.total">
                                <StarIcon class="h-4 w-4 mr-2 text-gray-1000 staricon font-semibold" fill="white"
                                    aria-hidden="true" />
                                <div class="text-center text-neutral-900 text-xs font-semibold mr-3">{{ course.rating?.average}}</div>
                                <div class="text-gray-600 text-xs mr-3">({{ course.rating?.total}})</div>
                            </div>
                            <div class="flex w-full sm:hidden">
                                    <div v-if="course.pricing.actual_price && course.pricing.actual_price != course.pricing.selling_price" class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">{{ course.pricing.actual_price }}</span>
                                    </div>
                                    <div v-if="course.pricing.selling_price">
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">{{ course.pricing.selling_price }}</span>
                                    </div>
                            </div>

                            <div v-if="course && course.pricing" class="border-t border-gray-200 hidden sm:flex items-center justify-between py-2">
                                <a v-if="course.accepting_enrolments" class="text-rose-500 text-base font-semibold" :href="route('frontend.package', { type: course.page.type, page: course.page.slug })">Enroll</a>
                                <RequestCallbackButton v-else label="Notify" css_class="text-indigo-800 text-base font-semibold"/>

                                <div class="flex">
                                    <div v-if="course.pricing.actual_price && course.pricing.actual_price != course.pricing.selling_price" class="mr-3">
                                        <span class="mr-1">₹</span>
                                        <span class="text-gray-600 text-base font-semibold line-through leading-[35px]">{{ course.pricing.actual_price }}</span>
                                    </div>
                                    <div v-if="course.pricing.selling_price">
                                        <span class="mr-1">₹</span>
                                        <span class="text-zinc-800 text-base font-semibold leading-[35px]">{{ course.pricing.selling_price }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-blue-800 text-md font-semibold flex justify-end mb-6" v-if="data && data.more && data.more.link">
                <a :href="data.more.link">{{data.more.label}} <span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></a>
            </div>
        </div>
        <div v-else class="border border-gray-300 text-center p-3 text-gray-600 w-full" role="button">No Data Available</div>
    </div>
</template>
<script>
import { StarIcon } from "@heroicons/vue/24/solid";
import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';

export default {
    props: {
        data: {
            type: Object,
            required: true
        },
    },
    components: {
        StarIcon,
        RequestCallbackButton
    },
    data() {
        return {
            courses: []
        }
    },
    methods: {
        index(page = 1) {
            let vm = this;
            let payload = {
                ids: vm.data.packages,
                limit: vm.data?.limit
            };
            axios.post(route('website.components.index', { component: 'certificate-courses', page: page }), payload).then(response => {
                vm.courses = response.data.data;
            }).catch(error => {
            });
        },
        formatDate(datetimestring) {
            let dateobj = new Date(datetimestring);
            let month = dateobj.toLocaleString('default', { month: 'short' });
            let day = dateobj.getDate();
            return `${month} ${day}`;
        }
    },
    watch:{
        "data.packages": function(){
            if(this.data && this.data.packages){
                this.index();
            }
        },
        "data.limit": function(){
            if(this.data && this.data.goal){
                this.index();
            }
        }
    },
    mounted() {
        this.index();
    }
}
</script>
