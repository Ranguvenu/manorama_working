<template>
    <template  v-for="(course, index) in data">
        <a :href="route('frontend.package', { type: course.page.type, page: course.page.page })">
            <div class="flex items-center cursor-pointer justify-between bg-rose-50 rounded-[10px] border border-rose-500 px-3 py-3 mb-2 compexam_toggle_wrap">
                <div class="text-red-950 text-sm font-medium  leading-[19px]">{{ course.title }}</div>
                <div><ChevronRightIcon class="h-4 w-3 text-gray-1000 font-semibold" aria-hidden="true"/></div>
            </div>
        </a>
    </template>
</template>
<script>
import { ChevronRightIcon } from '@heroicons/vue/24/solid'
    export default{
        components:{
            ChevronRightIcon
        },
        props:{
            data: {
                type: Array,
                required: true
            }
        },
        data(){
            return {

            }
        },
        methods:{ 

        },
        mounted(){

        }
    }
</script>