<template>
    <div>
        <div class="flow-root">
            <div class="float-left">
                <div class="text-medium">Permissions</div>
            </div>
            <div class="float-right">
                <TextInput class="py-1" v-model="search" placeholder="Search Permissions"/>
            </div>
        </div>
        <table class="mt-4">
            <thead>
                <tr>
                    <th>Capability</th>
                    <th>Permission</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(permission, index) in searched_permissions">
                    <td>
                        <div class="font-semibold text-gray-500">{{ permission.component }}</div>
                        <div class="text-sm">{{ permission.name }}</div>
                        <div class="text-sm">{{ permission.description }}</div>
                    </td>
                    <td>
                        <label class="flex items-center">
                            <input type="checkbox" :value="permission.id" @change="toggleCheckbox($event)" :checked="ischecked(permission.id)" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                            <span class="ml-2 text-sm text-gray-600">Allow</span>
                        </label>
                    </td>
                </tr>
                <tr v-if="!searched_permissions.length">
                    <td colspan="14">
                        <div class="text-center">No Permissions Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
export default{
    components:{
        TextInput
    },
    props:{
        permissions:{
            type : Array,
            required: true
        },
        modelValue: {
            type: Array,
            required: true
        }
    },
    data(){
        return{
            selected: [],
            search: ''
        }
    },
    methods: {
        toggleCheckbox(event){
            const { value, checked } = event.target;
			checked ? this.selected.push(parseInt(value)) : ((this.selected.indexOf(parseInt(value)) > -1) ? this.selected.splice(this.selected.indexOf(parseInt(value)), 1) : 0);
            console.log(this.selected);
            this.$emit('update:modelValue', this.selected);
        },
        ischecked(permission){
            return (this.selected.indexOf(permission) > -1) ? true : false;
        },
    },
    computed:{
        searched_permissions(){
            return this.permissions.filter((permission) => {
                return (
                    permission.name.toLowerCase()
                    .indexOf(this.search.toLowerCase()) != -1

                );
            });
        }
    },  
    mounted(){
        this.selected = this.modelValue;
    }
}
</script>
