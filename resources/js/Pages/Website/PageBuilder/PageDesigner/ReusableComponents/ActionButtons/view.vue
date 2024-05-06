<template>    
    <template v-for="(button, index) in buttons">
        <template v-if="button && button.type == 'icon'">
            <a :href="get_link(button.link)" :class="get_class(button.link)">
                <img :src="button.icon" class="mr-3 mb-2"/>
            </a>
        </template>
        <template v-else>
            <div :class="{'px-[18px] py-2.5 bg-rose-600 rounded-[5px] text-white text-base font-medium mb-2 mr-3': button.design === 'regular', 'px-[18px] py-2.5 bg-white text-rose-500 rounded-[5px] border border-rose-600 text-base font-medium mb-2 mr-3': button.design === 'outline'}">
                <template v-if="button && (button.type === 'link')">
                    <a :href="button.link">{{button.label}}</a>
                </template>
                <template v-if="button && button.type === 'cta'">
                    <RequestCallbackButton :label="button.label" :product="button.package" v-if="button.link == 'callback'"/>
                </template>
                <template v-if="button && button.type === 'scrollto'">
                    <ScrollToButton :label="button.label" :tab="button.link"/>
                </template>
            </div>
        </template>
    </template>
</template>
<script>
import RequestCallbackButton from '@/Modules/RequestCallback/index.vue';
import ScrollToButton from '@/Modules/ScrollTo/index.vue';
export default{
    components:{
        RequestCallbackButton,
        ScrollToButton
    },
    props:{
        buttons: {
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{ 
        get_link(link){
            return link ? link : 'javascript:void(0)';
        },
        get_class(link){
            return link ? 'cursor-pointer' : 'cursor-default';
        }
    },
    mounted(){

    }
}
</script>
