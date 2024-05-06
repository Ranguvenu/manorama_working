<template>
    <component :is="data.layout" :data="data"></component>
</template>
<script>
import LayoutOne from './layouts/layout-one.vue';
import LayoutTwo from './layouts/layout-two.vue';
export default {
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    components:{
        "layout-one": LayoutOne,
        "layout-two": LayoutTwo
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
