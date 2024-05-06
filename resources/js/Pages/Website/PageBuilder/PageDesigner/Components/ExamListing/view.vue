<template>
    <div :class="'flex items-start mb-2 md:justify-'+ data.title_alignment">
        <div class="w-[29px] h-[29px] mr-3">
            <img src="/images/pagebuilder/schoolexams/competition1.svg" />
        </div>
        <div class="md:text-center text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3">{{ data.title }}</div>
    </div>
    <div class="flex flex-row flex-wrap">
        <div class="w-1/4 pr-4 mb-4" v-for="(item, index) in data.items">
            <div class="bg-pink-100 rounded-[11px] border border-rose-500 flex items-center justify-between py-6 px-6 cursor-pointer"  v-on:click="navigate(item.url)">
                <div class="text-stone-950 text-[14px] font-semibold">{{item.description}}</div>
                <div>
                    <a href="#"><ChevronRightIcon class="h-6 w-6 text-rose-500 " aria-hidden="true"/></a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ChevronRightIcon } from "@heroicons/vue/24/outline";
export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {
        ChevronRightIcon
    },
    data() {
        return {
            active: 0,
            selected: {

            },
        }
    },
    methods: {
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
