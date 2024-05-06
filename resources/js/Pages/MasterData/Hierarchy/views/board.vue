<template>
    <div class="border p-3 rounded-lg bg-gray-200" >
        <div class="flex justify-between">
            <div>
                <div class="text-lg cursor-pointer" v-on:click="classes = !classes">{{ board.title }}</div>
                <div class="text-regular text-gray-600">Board</div>
            </div>
            <div class="flex">
                <a v-if="$has_capability('create-hierarchy')" href="javascript:void(0)" class="text-blue text-lg" @click="$emit('create-hierarchy', {show: true, parent: board.id,  depth: 2, type: 3, label: 'Class', extrafields: false})">Add Class</a>
                <a v-if="$has_capability('edit-hierarchy')" href="javascript:void(0)" class="text-blue text-lg mx-2 " data-te-toggle="tooltip" title="Edit" @click="$emit('create-hierarchy', {show: true, edit: board.id, parent: board.id,  depth: 2, type: 3, label: 'Board'})"><PencilSquareIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"/></a>
                <a v-if="$has_capability('delete-hierarchy')" href="javascript:void(0)" class="text-red-800 text-lg me-2"  data-te-toggle="tooltip" title="Delete" @click="$emit('delete-hierarchy', board)"><TrashIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!board.classes.length"/></a>
            </div>
        </div>
    </div>
    <template v-if="classes">
        <div class="ml-7 mt-4" v-for="(classes, index) in board.classes" :key="index" >
            <Classes :classes="classes" @create-hierarchy="create_hierarchy" @delete-hierarchy="delete_hierarchy"/>
        </div>
    </template>

</template>
<script>
    import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';
    import Classes from './classes.vue';
    export default{
        props:{
            board: {
                type: Object,
                required: true
            }
        },
        components:{
            Classes,
            TrashIcon,
            PencilSquareIcon
        },
        data(){
            return{
                classes: false
            }
        },
        methods:{ 
            create_hierarchy(hierarchy){
                this.$emit('create-hierarchy', hierarchy);
            },
            delete_hierarchy(hierarchy){
                this.$emit('delete-hierarchy', hierarchy);
            }
        },
        mounted(){

        }
    }
</script>
