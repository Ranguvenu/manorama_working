<template>
    <div>
        <div class="flex flex-row flex-wrap" v-if="results && results.length">
            <div class="lg:w-1/3 md:w-1/2 w-full pr-4 mb-4 flex flex-wrap" v-for="(result, index) in results" :key="index">
                <div class="w-full bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 flex flex-col shadow-[0_4px_14px_rgba(1,1,1,0.2)] rounded-lg">
                    <div class="relative">
                        <img class="rounded-tl-lg rounded-tr-lg w-full min-h-[185px] max-h-[185px] object-cover" :src="result.thumbnail" :alt="result.title" />
                        <div class="absolute  left-[10px] bottom-[15px] ">

                                    </div>
                        <div class="absolute right-[5px] top-[5px] bg-white px-1 rounded-lg packages_actions_wrap">
                            <ActionsDropdown align="right">
                                <template v-slot:content >
                                    <div class="divide-y border-lightestgrey">
                                        <a href="javascript:void(0)" v-if = "$has_capability('edit-videolist')" v-on:click="$emit('edit',result.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                         <a href="javascript:void(0)" v-if = "$has_capability('delete-videolist')" v-on:click="$emit('delete', result)" class="block py-1 px-4 actions_icon">Delete</a>
                                      
                                    </div>
                                </template>
                            </ActionsDropdown>
                        </div>
                    </div>
                    <div class="rounded-bl-lg rounded-br-lg px-4 pb-6 mt-5">
                        <div class="text-zinc-800 text-base font-semibold mb-3 leading-tight">{{ result.title }}</div>
                    
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="border border-gray-300 text-center p-3 text-gray-400 text-center">No Data Available</div>
        </div>
    </div>
</template>
<script>

import ActionsDropdown from '@/Components/ActionsDropdown.vue';

export default {
    components: {   
        ActionsDropdown
    },
    props: {
        results: {
            type: Array,
            required: true
        },
    },
    data() {
        return {
          
        }
    },
    methods: {
   
    },
    mounted() {

    }
}

</script>
