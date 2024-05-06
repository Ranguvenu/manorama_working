<template>
        <div class="flex flex-wrap items-center justify-between media_md:flex-col-reverse">
            <div class="flex-col flex md:w-1/2 custom_md:w-2/5 w-full">
                <div class="flex">
                    <div class="mr-2 hidden custom_md:hidden md:inline-block"><img src="/images/homepage/airplane.png" /></div>
                    <div class="text-black text-[25px] font-semibold leading-[35px]">{{data.title}}</div>
                </div>
                <div class="text-gray-600 text-base leading-[27px] ck-content" v-html="data.description"></div>
                <div class="flex flex-wrap items-center media_xs:flex-col-reverse mt-5">
                    <ActionButtonsView :buttons="data.buttons"/>
                </div>
            </div>
            <div class="flex items-center md:w-1/2 custom_md:w-2/5 w-full justify-center ">
                <div class="relative rounded-circle">
                    <img class="rounded-circle" :src="data.image"/>
                    <div class="hidden md:inline-block origin-top-left w-[25.61px] h-[27.06px]  strokes-full strokes-top">
                    </div>
                    <div class="hidden md:inline-block origin-bottom-left w-[25.61px] h-[27.06px] strokes-full strokes-btm">
                    </div>
                </div>
            </div>
        </div>
</template>
<script>


import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';

export default {
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    components:{
        ActionButtonsView
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
