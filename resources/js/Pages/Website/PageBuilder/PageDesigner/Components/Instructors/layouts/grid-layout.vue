<template>
    <div class="flex gap-2 justify-between items-center">
        <div :class="{
        'text-zinc-800 text-center text-[22px] sm:text-[25px] font-semibold mb-4': data.title_alignment === 'center',
        'text-zinc-800 text-left text-[22px] sm:text-[25px] font-semibold mb-4': data.title_alignment === 'left',
        'text-zinc-800 text-right text-[22px] sm:text-[25px] font-semibold mb-4': data.title_alignment === 'right'
        }">{{ data.title }}
        </div>
        <div v-if="data && data.view_all && data.view_all.label" class="text-blue-800 text-right font-semibold mb-4 mr-5">
            <a class="text-end text-sm sm:text-base justify-end" :href="data.view_all.url">{{data.view_all.label}}
                <span><img class="w-6 h-6 inline-block" src="/images/homepage/dotted-rightarw.png"/></span>
            </a>
        </div>
    </div>

    <div class="flex flex-row flex-wrap" >
        <div class="flex flex-wrap md:w-1/4 sm:w-1/2 w-full md:pr-4 sm:pr-4 mb-4" v-for="(item, index) in data.items">
            <div class="flex flex-col w-full rounded-[22px] border border-zinc-200 p-4">
                <div class="mb-4 relative w-full h-[180px] rounded-[14px] bg-cover bg-no-repeat bg-center"  :style="{'background-image': 'url(' + item.instructor_image + ')'}">
                    <!-- <img :src="item.instructor_image" :alt="item.name"   /> -->
                </div>
                <div class="text-center text-zinc-800 text-base font-semibold">{{ item.name }}</div>
                <div class="text-center mb-2">
                    <span class="text-center text-zinc-800 text-[10px] font-medium bg-pink-100 rounded-xl py-1 px-3">{{item.experience}}</span>
                </div>
                <div class="text-center text-gray-600 text-[13px] mb-2 " v-html="item.description"></div>
                <div class="text-center text-gray-600 text-[13px] font-semibold">{{ item.organization }}</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    computed:{

    },
    mounted(){

    }
}
</script>
