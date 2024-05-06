<template>
    <div class="py-3">
        <div class="flow-root">
            <div class="float-left clearfix">
                <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md py-1 shadow-sm" v-model="filters.type"  @change="filter('search', $event.target.value)">
                    <option value="-1">All Media</option>
                    <option v-for="(type, index) in data.types" :value="type">{{ type }}</option>
                </select>
                <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md py-1 shadow-sm mx-2" v-model="filters.date" @change="filter('search', $event.target.value)">
                    <option value="-1">All Dates</option>
                    <option v-for="(date, index) in data.dates" :value="date">{{ date }}</option>
                </select>
                <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md py-1 shadow-sm" v-model="filters.component"  @change="filter('search', $event.target.value)">
                    <option value="-1">All Components</option>
                    <option v-for="(component, index) in data.components" :value="component">{{ component }}</option>
                </select>
            </div>
            <div class="float-right clearfix">
                <input 
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md py-1 shadow-sm"
                    v-model="filters.search"
                    placeholder="Search"
                    @input="filter('search', $event.target.value)"/>
            </div>
        </div>
    </div>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue';
export default{
    props:{
        filters: {
            type: Object,
            required: true
        },
        data: {
            type: Object,
            required: true
        }
    },
    components:{
        InputLabel
    },
    data(){
        return{

        }
    },
    methods:{
        filter(key, value, emit=true){
            emit ? this.$emit('filter') : false;
        }
    },
    mounted(){

    }
}
</script>
