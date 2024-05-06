<template>
    <div>
        <div class="text-zinc-800" v-if="data.title">{{ data.title }}</div>
        <!-- <div class="mt-2"> -->
            <div class="ck-content" v-html="data.content"></div>
        <!-- </div> -->
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
        
    },
    mounted(){

    }
}
</script>
