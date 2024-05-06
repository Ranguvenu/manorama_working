<template>
    <div>
        <div v-for="(result, index) in results" class="block mb-3 p-3 bg-white border rounded shadow" v-if="results && results.length">
            <div class="flex justify-between items-center pb-2">
                <div class="break-all text-lg font-semibold text-gray-800">{{ result.title }}</div>
                <ActionsDropdown align="right" width="5" height="5"> 
                    <template v-slot:content>
                    <div class="divide-y border-lightestgrey">
                        <a :href="route('blog.show', {article: result.slug, category: type.slug})" class="block py-1 px-4 actions_icon" target="__blank">View</a>                                                
                        <a href="javascript:void(0)" v-if="$has_capability('edit-article')" v-on:click="$emit('edit',result.id)" class="block py-1 px-4 actions_icon">Edit</a>
                        <a href="javascript:void(0)" v-if="$has_capability('delete-article')" v-on:click="$emit('delete', result)" class="block py-1 px-4 actions_icon">Delete</a>
                    </div>
                    </template>
                </ActionsDropdown>
            </div>
            <div class="break-all text-sm text-gray-600 mt-2"><span v-html="result.short_description.slice(0,200)"></span></div>
            <div class="border-t-2 my-4"></div>
            <div class="flex justify-between items-center pb-2">
                <div class="flex flex-row flex-wrap">
                    <span v-for="(category, index) in result.categories">
                        <span class="bg-slate-300 px-4 py-1 mx-2 mb-2 rounded text-sm flex" v-if="category">{{ category }}</span>
                    </span>
                </div>
                <div class="bg-green-600 text-white px-4 rounded-xl text-sm" v-if="result.is_published">
                    Published
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
            },
            type:{
                type: Object,
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
