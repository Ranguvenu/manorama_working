<template>
    <div class="text-zinc-800 text-[25px] font-semibold mb-12">{{data.title}}</div>
    <div class="flex flex-col" v-for="(item, index) in data.items">
        <div class="flex media_md:flex-wrap items-center mb-8">
            <div class="md:pr-8 media_md:mb-6"><img class="min-w-[275px] h-[275px] rouned-lg" :src="item.image" :alt="item.name" /></div>
            <div class="flex flex-col flex-grow justfi-center">
                <div class="text-base leading-relaxed mb-4">{{ item.description }}</div>
                <div class="text-zinc-800 text-[19px] font-semibold mb-1">{{item.name}}</div>
                <div class="text-zinc-800 text-[19px] font-semibold">{{item.designation}}</div>
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
