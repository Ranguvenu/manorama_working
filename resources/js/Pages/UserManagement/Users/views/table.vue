<template>
    <div>
        <table class="table">
            <thead>
                <tr class="text-sm">
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>
                        <div v-if="type.slug == 'staff'">Roles</div>
                        <div v-else>Type</div>
                    </th>
                    <th v-if="$has_capability(editcapability) || $has_capability(deletecapability)">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for ="(data, index) in results" :key="data.id" class="text-sm" v-if="results.length">
                    <td>{{ data.firstname }} {{data.lastname }}</td>
                    <td>{{ data.phone }}</td>
                    <td>{{ data.email }}</td>
                    <td>
                        <div v-if="type.slug == 'staff'">{{ data.roles }}</div>
                        <div v-else>
                            <span v-if="data.is_subscriber">Subscriber</span>
                            <span v-else>Guest User</span>
                        </div>
                    </td>
                    <td v-if="$has_capability(editcapability) || $has_capability(deletecapability)" >
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability(viewcapability)"  v-on:click="$emit('view', data.id)" class="block py-1 px-4 actions_icon">Details</a>
                                <a href="javascript:void(0)" v-if="$has_capability(editcapability)" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <PasswordReset v-if="$has_capability(editcapability)" :user="data.id"/>
                                <a href="javascript:void(0)" v-if="$has_capability(deletecapability)&& !data.is_deleted" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
                                <a href="javascript:void(0)" v-if="type.slug != 'staff' && data.is_deleted" v-on:click="$emit('activate', data.id)" class="block py-1 px-4 actions_icon">Activate</a>
                            </div>
                          </template>
                        </ActionsDropdown>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="14" class="text-center text-gray-500">
                        No Data Available
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import { EyeIcon } from "@heroicons/vue/24/solid";
import Modal from '@/Components/Modal.vue';
import ActionsDropdown from '@/Components/ActionsDropdown.vue';
import PasswordReset from './password-reset.vue';
    export default{
        props:{
            results: {
                type: Array,
                required: true
            },
            meta: {
                type: Object,
                required: true
            },
            type:{
                type: Object,
                required: true
            }
        },
        components: { 
            EyeIcon,
            Modal,
            ActionsDropdown,
            PasswordReset
        },
        data(){
            return{
                editcapability: (this.type.slug == 'staff') ? 'edit-staff' : 'edit-subscribers',
                deletecapability: (this.type.slug == 'staff') ? 'delete-staff' : 'delete-subscribers',
                viewcapability: (this.type.slug == 'staff') ? 'view-staff' : 'view-subscribers'

                
            }
        },
        methods:{
            
        },
        mounted(){
            
        }
    }
</script>
