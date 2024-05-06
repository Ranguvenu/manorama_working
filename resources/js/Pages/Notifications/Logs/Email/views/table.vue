<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Channel</th>
                    <th>To Email</th>
                    <th>To User</th>
                    <th>Sent At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results" v-if="results && results.length">
                    <td>{{ data.channel }}</td>
                    <td>{{ data.to_email }}</td>
                    <td>{{ data.to_user }}</td>
                    <td>{{ data.created_at }}</td>
                    <td>
                        <a href="javascript:void(0)" v-on:click="$emit('view-history', data)" title="Summary">
                            <EyeIcon class="ms-2 h-6 w-6 text-gray-1000 cursor-pointer"/>
                        </a>
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
    import { EyeIcon } from "@heroicons/vue/24/outline";

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
            ActionsDropdown,
            EyeIcon
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
