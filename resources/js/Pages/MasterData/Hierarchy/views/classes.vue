<template>
    <div class="border p-3 rounded-lg">
        <div class="flex justify-between">
            <div>
                <div class="text-lg cursor-pointer" v-on:click="subjects = !subjects">{{ classes.title }}</div>
                <div class="text-regular text-gray-600">Class</div>
            </div>
            <div class="flex">
                <a v-if="$has_capability('create-hierarchy')" href="javascript:void(0)" class="text-blue text-lg" @click="$emit('create-hierarchy', {show: true, parent: 0, depth: 3, parent: classes.id, type: 4, label: 'Subject', extrafields: true})">Add Subject</a>
                <a v-if="$has_capability('edit-hierarchy')" href="javascript:void(0)" class="text-blue text-lg mx-2" data-te-toggle="tooltip" title="Edit" @click="$emit('create-hierarchy', {show: true, edit: classes.id, parent: 0, depth: 3, parent: classes.id, type: 4, label: 'Class'})"><PencilSquareIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true"/></a>
                <a v-if="$has_capability('delete-hierarchy')" href="javascript:void(0)" class="text-red-800 text-lg me-2"  data-te-toggle="tooltip" title="Delete" @click="$emit('delete-hierarchy', classes)"><TrashIcon class="mx-auto h-5 w-5 text-gray-1000" aria-hidden="true" v-if="!classes.subjects.length"/></a>
            </div>
        </div>
    </div>
    <div>
        <template v-if="subjects">
            <div class="ml-7 mt-4" v-for="(subject, index) in classes.subjects" :key="index" >
                <Subjects :subject="subject" @create-hierarchy="create_hierarchy" @delete-hierarchy="delete_hierarchy"/>
            </div>
        </template>
    </div>
</template>
<script>
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid';
import Subjects from './subjects.vue';
export default{
    components:{
        Subjects,
        TrashIcon,
        PencilSquareIcon
    },
    props:{
        classes: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            subjects: false
        }
    },
    methods: {
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
