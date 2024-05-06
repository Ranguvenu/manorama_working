<template>
    <img :src="data.url" class="absolute top-0 left-0 bottom-0 right-0 m-auto max-w-full max-h-full p-2" :alt="data.alttext"/>
</template>
<script>
    export default{
        props:{
            data: {
                type: Object,
                required: true
            }
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
