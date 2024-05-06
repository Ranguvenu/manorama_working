<template>
    <div class="border p-3 rounded-lg bg-gray-200">
        <div class="flex justify-between">
            <div>
                <div class="text-lg">{{ subject.title }}</div>
                <div class="text-regular text-gray-600">Subject</div>
            </div>
            <div class="flex">
                <a v-if="$has_capability('edit-hierarchy')" href="javascript:void(0)" class="text-blue text-lg mx-2"  data-te-toggle="tooltip" title="Edit" @click="$emit('create-hierarchy', {show: true, edit: subject.id, parent: 0, depth: 3, parent: subject.id, type: 4, label: 'Subject'})"><PencilSquareIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"/></a>
                <a v-if="$has_capability('delete-hierarchy')" href="javascript:void(0)" class="text-red-800 text-lg me-2" data-te-toggle="tooltip" title="Delete" @click="$emit('delete-hierarchy', subject)"><TrashIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!subject.length"/></a>
            </div>
        </div>
    </div>
</template>
<script>
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';

export default{
    components:{
        PencilSquareIcon,
        TrashIcon
    },
    props:{
        subject:{
            type: Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods: {

    },
    mounted(){

    }
}
</script>
