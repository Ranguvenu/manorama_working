<template>
    <div class="text-zinc-800 text-[25px] font-semibold leading-[35px] mb-3">{{data.title}}</div>
    <div class="flex flex-wrap -mx-2">
        <div :class="'md:w-1/'+  data.no_of_columns + ' px-2 sm:w-1/2 w-full flex mb-2'" v-for="(item, index) in data.items">
            <div :class="'flex w-full bg-rose-50 rounded-[17px] shadow-[0_4px_24px_9px_rgba(0,0,0,0.02)] border border-'+ data.border_styles+ ' border-rose-500 items-center py-6 px-6'" v-bind:style="get_styles(data)">
                <div class="mr-4"><img class="min-w-[20px] h-5" :src="item.icon"></div>
                <div class="text-[15px] font-medium leading-[21px]">{{item.description}}</div>
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
    components:{

    },
    data(){
        return{

        }
    },
    methods:{
        get_styles(data){
			return {
				...this.background(data)
			};
		},
		background(data){
			let returns = {};
			returns.backgroundColor = data.background_color
			returns.color = data.text_color
			returns['border-color'] = data.border_color
			return returns;
		},
    },
    mounted(){

    }
}
</script>
<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
</style>
