<template>
    <div>
        <table class="min-w-full text-left text-sm font-light table-auto">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th class="w-[40%]">Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th v-if="$has_capability('edit-faq') || $has_capability('delete-faq')" >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length">
                    <td>{{ data.title }}</td>
                    <td>{{ data.category }}</td>
                    <td class="ck_content" v-html="data.description"></td>
                    <td>{{ data.status }}</td>
                    <td  v-if="$has_capability('edit-faq') || $has_capability('delete-faq')">
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('edit-faq')" v-on:click="$emit('edit',data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-faq')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
                            </div>
                          </template>
                        </ActionsDropdown>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
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
            meta: {
                type: Object,
                required: true
            }
        },
        components:{
            ActionsDropdown
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
