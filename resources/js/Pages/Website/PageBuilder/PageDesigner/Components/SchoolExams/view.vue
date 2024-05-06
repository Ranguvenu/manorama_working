<template>
    <div :class="'flex items-start mb-2 md:justify-'+ data.title_alignment">
        <div class="w-[29px] h-[29px] mr-3">
            <img src="/images/homepage/school.png" />
        </div>
        <div class="md:text-center text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3">{{ data.title }}</div>
    </div>
    <div :class="'flex items-center text-gray-600 text-base mb-6 md:justify-'+ data.title_alignment">{{ data.caption }}</div>
    <div :class="'flex flex-wrap overflow-x-auto no-scrollbar  items-start justify-'+ data.title_alignment">
        <div v-for="(category, index) in data.categories" :key="index">
            <div v-on:click="switch_tab(category, index)"
                :class="{ 'h-[30px] bg-white rounded border border-pink-300 text-center mx-1': active === index, 'h-[30px] bg-white rounded border border-zinc-300 text-center mx-1': active !== index }"
                class="px-5 cursor-pointer mb-6">
                <a class="mb-2 text-nowrap"
                    :class="{ 'text-rose-500 text-base font-semibold leading-[27px] active': active === index, 'text-gray-600 text-base font-medium leading-[27px]': active !== index }">{{ category.title }}</a>
            </div>
        </div>
    </div>
    <div class="flex flex-row items-center flex-wrap mb-4">
        <div v-for="(course, index) in selected.items" :key="index"
            class="w-full custom_md:w-1/3 md:w-1/4 sm:w-1/2 custom_xs:w-1/2 flex pr-4 mb-4">
            <div class="w-full bg-violet-50 rounded-lg border-b border-indigo-800 flex items-center justify-between px-6 py-8 cursor-pointer" v-on:click="navigate(course.url)">
                <div>
                    <div class="text-black text-sm font-medium">{{ selected.title }}</div>
                    <div class="text-zinc-800 text-xl font-semibold leading-[27px]">{{ course.label }}</div>
                </div>
                <div>
                    <ChevronDoubleRightIcon class="h-8 w-8 text-gray-1000 font-semibold" aria-hidden="true" />
                </div>
            </div>
        </div>
    </div>
    <div class="text-blue-800 text-md font-semibold flex justify-end mb-6" v-if="selected && selected.more"><a
            :href="selected.more.link">{{ selected.more.label }} <span><img class="inline-block"
                    src="/images/homepage/dotted-rightarw.png" /></span></a></div>
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
