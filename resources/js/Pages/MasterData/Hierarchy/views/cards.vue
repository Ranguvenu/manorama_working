<template>
    <div class="mt-3">
        <div v-for="(hierarchy, index) in data" v-if="data && data.length" :key="index">
            <Card :data="hierarchy" @create-hierarchy="create" @delete-hierarchy="delete_hierarchy"/>
        </div>
        <div v-else>
            <div class="text-center">No Data Available</div>
        </div>
    </div>
</template>
<script>
import Card from "./card.vue";
export default{
    props:{ 
        data: {
            type: Array,
            required: true
        },
        meta: {
            type: Object,
            required: true
        }
    },
    components:{
        Card
    },
    emits:['create-hierarchy'],
    data(){
        return{

        }
    },
    methods:{
        create(hierarchy){
            this.$emit('create-hierarchy', hierarchy);
        },
        delete_hierarchy(hierarchy){
            this.$emit('delete-hierarchy', hierarchy);
        }
    },
    mounted(){

    }
}
</script>
