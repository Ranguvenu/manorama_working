<template>
    <div v-if="data && data.title" class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-8">{{data.title}}</div>
    <div class="flex flex-wrap">
        <div  v-for="(item, index) in data.items" :class="'md:w-1/' +data.number_of_columns + ' w-full flex mb-3'">
            <div v-bind:style="get_styles(data)" class="w-full flex custom_md:flex-wrap rounded-[15px] justify-between items-center px-6 py-6 md:mx-6">
                <div class="flex flex-col">
                    <div class="text-zinc-800 text-[23px] font-semibold mb-8">{{item.title}}</div>
                    <ActionButtonsView :buttons="item.buttons" />

                </div>
                <div class="md:flex hidden md:w-[200px] flex-shrink-0">
                    <img :src="item.image" :alt="item.title" class="rounded-xl w-full md:w-[200px] flex-shrink-0"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import ActionButtonsView from '@/Pages/Website/PageBuilder/PageDesigner/ReusableComponents/ActionButtons/view.vue';

export default defineComponent ({
    name: 'Basic',
    props:{
        data:{
            type: Object,
            required: true
        },

    },
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        ActionButtonsView
    },
    data(){
        return{

        }
    },
    methods:{
        get_styles(data){
			return {
				...this.primaryColor(data)
			};
		},
        primaryColor(data){
			let returns = {};
    			returns['background-image'] = data.bg_gradient_color
			return returns;
		},
    },
    mounted(){
    },
    computed: {
    }
})
</script>
