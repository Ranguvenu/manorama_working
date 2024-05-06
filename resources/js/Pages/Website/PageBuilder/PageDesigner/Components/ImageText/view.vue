<template>
    <component :is="data.media_alignment" :data="data"></component>
</template>
<script>
import LeftLayout from './layouts/left-layout.vue';
import RightLayout from './layouts/right-layout.vue';
export default {
    props:{
        data:{
            type: Object,
            required: true
        }
    },
    components:{
        "left-layout": LeftLayout,
        "right-layout": RightLayout
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
