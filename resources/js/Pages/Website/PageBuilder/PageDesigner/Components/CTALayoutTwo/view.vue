<template>
    <div class="bggrid">
        <div class="flex flex-wrap items-center md:px-6 py-12">
            <div class="flex md:hidden mb-3 items-center">
                <div class="text-zinc-800 text-[22px] sm:text-[25px] font-semibold leading-[24px]">{{data.title}}</div>
            </div>
            <div class="flex md:hidden text-gray-600 text-base mb-4">{{data.caption}}</div>
            <div class="md:pr-12 md:w-1/2 md:mb-3">
                <img :src="data.image"/>
            </div>
            <div class="flex flex-col md:w-1/2 md:pl-3">
                <div class="md:flex hidden items-end mb-2">
                    <div class="text-zinc-800 text-[25px] font-semibold leading-[24px]">{{data.title}}</div>
                </div>
                <div class="md:flex hidden text-gray-600 text-base mb-4">{{data.caption}}</div>
                <div class="bg-white rounded border-b border-pink-400 px-6 py-6 mb-4" v-for="(feature, index) in data.features">
                    <div class="text-zinc-800 text-[17px] font-semibold">{{feature.title}}</div>
                    <div class="text-gray-600 text-xs">{{feature.caption}}</div>
                </div>
                <div class="text-blue-800 text-md font-semibold" v-if="data && data.more && data.more.link"><a :href="data.more.link" >{{data.more.label}}</a><span><img class="inline-block" src="/images/homepage/dotted-rightarw.png" /></span></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },

    },
    components: {
    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {
    },
    computed: {

    }
}
</script>
