<template>
    <div v-if="response && response.data && response.data.length">
        <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3">Courses</div>
        <div class="flex flex-row items-stretch flex-wrap mb-4">
            <div class="w-full custom_md:w-1/3 md:w-1/4 sm:w-1/2 custom_xs:w-1/2 flex pr-4 mb-4" v-for="(page, index) in response.data">
                <a class="w-full" v-if="page.page_type == 'package'" :href="route('frontend.package', { page: page.slug, type: page.page_type })">
                    <div class="bg-pink-100 rounded-[11px] align-items-stretch border border-rose-500 flex items-center justify-between py-6 px-6 cursor-pointer" v-on:click="navigate(course.url)">
                        <div>
                            <div class="text-gray-800 text-md font-semibold">{{ page.title }}</div>
                        </div>
                        <div>
                            <ChevronRightIcon class="h-6 w-6 text-rose-500 font-semibold" aria-hidden="true" />
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import { ChevronRightIcon } from "@heroicons/vue/24/solid";
export default{
    components:{
        ChevronRightIcon
    },
    props:{
        response: {
            type: Array,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){

    }
}
</script>