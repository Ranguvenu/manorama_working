<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results" v-if="results && results.length">
                    <td class="break-all">{{ data.title }}</td>
                    <td>{{ data.category_name }}</td>
                    <td>{{ data.subject }}</td>
                    <td>
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a :href="route('careers.job.applications.index', {job: data.slug})" class="block py-1 px-4 actions_icon">Applications</a>
                                <a href="javascript:void(0)" v-if="$has_capability('edit-job-postings')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-job-postings')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
            meta:{
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
