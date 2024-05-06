<template>
    <div>
        <Header :type="type" :current="user" @close="close" @refresh="index"/>
    </div>
</template>
<script>
import Header from './header.vue';

export default{
    components:{
        Header,

    },
    props:{
        type: {
            type: Object,
            required: true
        }
    },
    emits: ["hide", "refresh"],
    data(){
        return {
            show: false,
            result: {
               data: [],
               links: [],
               meta: [] 
            },
        }
    },
    methods:{
        close(){
            this.user = 0;
        },
        reset(){
            this.filters = this.initialize();
        }
    },
    mounted(){

    }
}
</script>
