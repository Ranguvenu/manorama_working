<template>
    <div class="text-3xl font-bold">{{  data.title }}</div>
    <div class="mt-2 grid grid-cols-12 gap-x-6 gap-y-8 sm:grid-cols-12">
        <div :class="get_cols_class" class="w-full" v-for="(item, index) in data.items">
            <div class="p-6 border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700" v-bind:style="get_color(data.background)">
                <div class="text-xl font-bold text-left text-gray-900">{{ item.title }}</div>
                <div class="text-left mt-2 text-gray-800 ck-content" v-html="item.description"></div>
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
        get_color(color){
            let returns = {}
            returns['background-color'] = color
            return returns;
        }
    },
    computed:{
        get_cols_class(){
            let cols = Math.ceil(12 / parseInt(this.data.columns));
            return 'col-span-'+cols;
        }
    },
    mounted(){

    }
}
</script>
