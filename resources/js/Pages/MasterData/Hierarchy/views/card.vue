<template>
    <div class="mb-3">
        <div class="border rounded-lg pb-3">
            <div class="ml-7 mt-4 ">
                <div class="flex justify-between">
                    <div>
                        <div class="text-lg text-blue-800 cursor-pointer" v-on:click="board = !board">{{ data.title }}</div>
                        <div class="text-regular text-gray-600">Goal</div>
                    </div>
                    <div class="flex">
                        <a v-if="$has_capability('create-hierarchy')" href="javascript:void(0)" class="text-blue" @click="$emit('create-hierarchy', {show: true, parent: data.id, type: 2, depth: 1, label: 'Board', extrafields: false})">Add Board</a>
                        <a v-if="$has_capability('edit-hierarchy')" href="javascript:void(0)" class="text-blue text-lg mx-2" @click="$emit('create-hierarchy', {show: true, edit:data.id , parent: data.id, type: 2, depth: 1, label: 'Goal'})"  data-te-toggle="tooltip" title="Edit"><PencilSquareIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"/></a>
                        <a v-if="$has_capability('delete-hierarchy')" href="javascript:void(0)" class="text-red-800 text-lg me-2" @click="$emit('delete-hierarchy', data)" data-te-toggle="tooltip" title="Delete"><TrashIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!data.boards.length"/></a>
                    </div>
                </div>
            </div>
            <template v-if="board">
                <div class="ml-7 mt-4" v-for="(board, index) in data.boards" :key="index">
                    <Board :board="board" @create-hierarchy="create_hierarchy" @delete-hierarchy="delete_hierarchy"/>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
    import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';
    import Board from './board.vue';

    export default{
        components:{
            PencilSquareIcon,
            TrashIcon,
            Board
        },
        props:{
            data: {
                type: Object,
                required: true
            }
        },
        emits: ['create-hierarchy'],
        data(){
            return {
                board: false,
            }
        },
        methods:{
            create_hierarchy(hierarchy){
                this.$emit('create-hierarchy', hierarchy);
            },
            delete_hierarchy(hierarchy){
                this.$emit('delete-hierarchy', hierarchy);
            }
        }

    }
</script>
