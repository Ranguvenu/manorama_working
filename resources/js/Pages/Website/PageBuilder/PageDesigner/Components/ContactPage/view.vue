<template>
        <div class="border-b border-stone-300">
            <ul class="flex nav_list mb-8">
                <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in data.breadcrumps">
                    <a :href="breadcrump.active ? breadcrump.link : 'javascript:void(0)'" class="text-sm" :class="{'active': !breadcrump.active}">{{ breadcrump.title }}</a>
                </li>
            </ul>
            <div class="flex flex-wrap justify-between mb-6">
                <div class="flex flex-col md:w-1/2 w-full md:pr-[95px]">
                    <div><span class="text-[55px] font-semibold" v-bind:style="get_styles(data)">{{ data.primary_title }} </span><span class="text-rose-500 text-[55px] font-semibold" v-bind:style="get_style(data)">{{data.secondary_title}}</span></div>
                    <div class="ck-content" v-html="data.description"></div>
                </div>
                <ContactForm/>
            </div>
        </div>
</template>
<script>
import { defineComponent } from 'vue';
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ContactForm from '@/Modules/ContactForm/index.vue';

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
        InputLabel,
        TextInput,
        ContactForm
    },
    data(){
        return{
            form: this.initialize(),
        }
    },
    methods:{
        initialize(){
            return{
                name: '',
                email: '',
                phone: '',
                message: ''
            }
        },
        get_styles(data){
			return {
				...this.primaryColor(data)
			};
		},
		primaryColor(data){
			let returns = {};
			returns.color = data.font_color_primary
			return returns;
		},
        get_style(data){
			return {
				...this.color(data)
			};
		},
		color(data){
			let returns = {};
			returns.color = data.font_color_secondary
			return returns;
		},
    },
    mounted(){
    },
    computed: {

    }
})
</script>
