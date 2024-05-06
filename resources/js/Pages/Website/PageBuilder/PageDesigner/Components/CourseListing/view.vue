<template>
    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3" v-if="data && data.title">{{data.title}}</div>
    <div class="text-gray-600 text-base mb-6" v-if="data && data.caption">{{ data.caption }}</div>
    <div class="flex overflow-x-auto no-scrollbar items-start justify-left">
        <div v-for="(category, index) in data.categories" :key="index">
            <div v-on:click="switch_tab(category, index)"
                :class="{ 'h-[30px] bg-white rounded border border-pink-300 text-center mx-1': active === index, 'h-[30px] bg-white rounded border border-zinc-300 text-center mx-1': active !== index }"
                class="px-5 cursor-pointer mb-6">
                <a class="mb-2 text-nowrap"
                    :class="{ 'text-rose-500 text-base font-semibold leading-[27px] active': active === index, 'text-gray-600 text-base font-medium leading-[27px]': active !== index }">{{ category.title }}</a>
            </div>
        </div>
    </div>
    <div class="flex flex-row items-stretch flex-wrap mb-4">
        <div v-for="(course, index) in selected.items" :key="index"
            class="w-full lg:w-1/4 md:w-1/2 sm:w-1/2 flex pr-4 mb-4">
            <div class="w-full bg-pink-100 rounded-[11px] align-items-stretch border border-rose-500 flex items-center justify-between py-4 px-4 cursor-pointer" v-on:click="navigate(course.url)">
                <div>
                    <div class="text-stone-950 text-lg font-semibold">{{ course.label }}</div>
                </div>
                <div>
                    <ChevronDoubleRightIcon class="h-6 w-6 text-rose-500 font-semibold" aria-hidden="true" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ChevronDoubleRightIcon } from "@heroicons/vue/24/solid";
export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {
        ChevronDoubleRightIcon
    },
    data() {
        return {
            active: 0,
            selected: {

            },
        }
    },
    methods: {
        switch_tab(category, index) {
            this.active = index;
            this.selected = category;
        },
        navigate(url){
            window.open(url);
        }
    },
    mounted() {
        if (this.data.categories && this.data.categories.length) {
            this.selected = this.data.categories[0];
        }
    },
    computed: {

    }
}
</script>
