<template>
    <div >
        <div  v-if="results && results.length">
            <div v-for="(result, index) in results" :key="index" class="block mb-3 p-3 bg-white border rounded shadow">
                <div class="flex justify-between items-center pb-2">
                    <div class="text-lg font-semibold text-gray-800">{{ result.title }}</div>
                    <ActionsDropdown align="right" width="5" height="5"> 
                        <template v-slot:content>
                        <div class="divide-y border-lightestgrey">
                            <a :href="route('studymaterial.show', {material: result.slug})" class="block py-1 px-4 actions_icon" target="__blank">View</a>
                            <a href="javascript:void(0)" v-if = "$has_capability('edit-studymaterial')" v-on:click="$emit('edit',result.id)" class="block py-1 px-4 actions_icon">Edit</a>
                            <a href="javascript:void(0)" v-if = "$has_capability('delete-studymaterial')" v-on:click="$emit('delete', result)" class="block py-1 px-4 actions_icon">Delete</a>
                        </div>
                        </template>
                    </ActionsDropdown>
                </div>
                <div class="break-all text-sm text-gray-600 mt-2"><span v-html="result.description.slice(0,200)"></span></div>
                <div class="border-t-2 my-4"></div>
                <div class="flex justify-between items-center pb-2">
                    <div>
                    
                    </div>
                    <div class="bg-green-600 text-white px-4 rounded-xl text-sm" v-if="result.is_published">
                        Published
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="border border-gray-300 p-3 text-sm text-gray-600 text-center">No Data Available</div>
        </div>
    </div>
</template>

<script>
    import ActionsDropdown from '@/Components/ActionsDropdown.vue';
   export default{
        props:{
            results: {
                type: Array,
                required: true
            }
        },  
        components:{
            ActionsDropdown,
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
