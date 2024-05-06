<template>
        <div>
            <div class="text-black text-[22px] font-semibold mb-1">{{data.title}}</div>
            <div class="text-black text-base font-medium mb-4">{{data.caption}}</div>
            <div class="flex flex-wrap justify-between">
                <div class="lg:w-2/5 md:w-1/2 w-full lg:pr-12 md:pr-6"><LeadCaptureForm/></div>
                <div class="md:flex hidden flex-col lg:w-3/5 md:w-1/2 lg:pl-12 md:pr-6">
                    <img :src="data.image" v-if="data && data.image" class="w-full"/>

                    <!-- <div>
                        <span class="text-55px font-semibold" >{{ data.primary_title }}</span>
                        <span class="text-rose-500 text-55px font-semibold" >{{ data.secondary_title }}</span>
                    </div>
                    <div class="ck-content" v-html="data.description"></div> -->
                </div>
            </div>
        </div>
</template>
<script>
import { defineComponent } from 'vue';
import LeadCaptureForm from '@/Modules/LeadCaptureForm/index.vue';

export default defineComponent ({
    name: 'Basic',
    props:{
        data:{
            type: Object,
            required: true
        },
    },
    components: {
        LeadCaptureForm,
        defineComponent
    },
    data(){
        return{
        }
    },
    methods:{
    },
    mounted(){
    },
    computed: {

    }
})
</script>
