<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Established On</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results" v-if="results && results.length">
                    <td>
                        <div class="w-16 h-16">
                            <img v-if="data.logo" :src="data.logo" />
                            <PhotoIcon v-if="!data.logo" class="text-primary h-15 w-15" aria-hidden="true"/>
                        </div>
                    </td>
                    <td>{{ data.name }}</td>
                    <td>{{ data.established_on }}</td>               
                    <td>{{ data.address }}</td>
                    <td>{{ data.location }}</td>
                    <td>
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('view-universities')" v-on:click="$emit('view', data.id)" class="block py-1 px-4 actions_icon">View</a>
                                <a href="javascript:void(0)" v-if="$has_capability('edit-universities')" v-on:click="$emit('edit',data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-universities')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
    import Button from "@/Components/Button.vue";
    import { PhotoIcon } from "@heroicons/vue/24/outline";
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
            Button,
            PhotoIcon,
        },
        data(){
            return{
                data : [],
                show :false

            }
        },
        methods:{

        },
        mounted(){
            
        }
    }
</script>
